document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('[data-fym-deck]').forEach((deck) => {
    const cards = Array.from(deck.querySelectorAll('[data-fym-card]'));
    const actions = deck.querySelector('.fym-card-actions');
    const status = deck.querySelector('.fym-card-status');
    const complete = deck.querySelector('[data-fym-complete]');
    const restart = deck.querySelector('[data-fym-restart]');
    let activeIndex = cards.findIndex((card) => !card.hidden);
    let isAnimating = false;
    let pointerStart = null;

    if (!cards.length || !actions || !status || !complete || !restart) {
      return;
    }

    if (activeIndex < 0) {
      activeIndex = 0;
      cards[activeIndex].hidden = false;
    }

    const finishDeck = () => {
      actions.hidden = true;
      complete.hidden = false;
      status.textContent = deck.dataset.fymCompletionMessage;
      restart.focus();
    };

    const showNextCard = (direction) => {
      if (isAnimating || activeIndex >= cards.length) {
        return;
      }

      const currentCard = cards[activeIndex];
      isAnimating = true;
      currentCard.classList.add(direction === 'like' ? 'is-liking' : 'is-rejecting');

      window.setTimeout(() => {
        currentCard.hidden = true;
        currentCard.classList.remove('is-liking', 'is-rejecting');
        currentCard.style.removeProperty('transform');
        activeIndex += 1;
        isAnimating = false;

        if (activeIndex >= cards.length) {
          finishDeck();
          return;
        }

        cards[activeIndex].hidden = false;
        status.textContent = `${cards[activeIndex].querySelector('.fym-card__font-name')?.textContent || 'Next font'}. ${cards.length - activeIndex} fonts left.`;
      }, 320);
    };

    const handleAction = (action) => {
      if (isAnimating || activeIndex >= cards.length) {
        return;
      }

      if (action === 'like') {
        const homepage = cards[activeIndex].dataset.fontHomepage;
        let destination;

        if (!homepage) {
          status.textContent = 'This font does not have a homepage link yet.';
          return;
        }

        try {
          destination = new URL(homepage);
        } catch (error) {
          status.textContent = 'This font does not have a valid homepage link yet.';
          return;
        }

        if (!['http:', 'https:'].includes(destination.protocol)) {
          status.textContent = 'This font does not have a valid homepage link yet.';
          return;
        }

        window.location.assign(destination.href);
        return;
      }

      showNextCard('reject');
    };

    actions.querySelectorAll('[data-fym-action]').forEach((button) => {
      button.addEventListener('click', () => handleAction(button.dataset.fymAction));
    });

    restart.addEventListener('click', () => {
      cards.forEach((card, index) => {
        card.hidden = index !== 0;
        card.classList.remove('is-liking', 'is-rejecting');
        card.style.removeProperty('transform');
      });

      activeIndex = 0;
      isAnimating = false;
      actions.hidden = false;
      complete.hidden = true;
      status.textContent = '';
      actions.querySelector('[data-fym-action="reject"]')?.focus();
    });

    const activeCard = () => cards[activeIndex];
    deck.addEventListener('pointerdown', (event) => {
      if (event.pointerType === 'mouse' && event.button !== 0) {
        return;
      }
      if (isAnimating || !activeCard() || !activeCard().contains(event.target)) {
        return;
      }
      pointerStart = { x: event.clientX, y: event.clientY, pointerId: event.pointerId };
      activeCard().setPointerCapture(event.pointerId);
    });

    deck.addEventListener('pointerup', (event) => {
      if (!pointerStart || pointerStart.pointerId !== event.pointerId) {
        return;
      }

      const deltaX = event.clientX - pointerStart.x;
      const deltaY = event.clientY - pointerStart.y;
      pointerStart = null;

      if (Math.abs(deltaX) < 80 || Math.abs(deltaX) < Math.abs(deltaY)) {
        if (activeCard()) {
          activeCard().style.removeProperty('transform');
        }
        return;
      }

      if (activeCard()) {
        activeCard().style.removeProperty('transform');
      }
      handleAction(deltaX < 0 ? 'reject' : 'like');
    });

    deck.addEventListener('pointercancel', () => {
      pointerStart = null;
      if (activeCard()) {
        activeCard().style.removeProperty('transform');
      }
    });

    deck.addEventListener('pointermove', (event) => {
      if (!pointerStart || pointerStart.pointerId !== event.pointerId || !activeCard()) {
        return;
      }

      const deltaX = event.clientX - pointerStart.x;
      const deltaY = event.clientY - pointerStart.y;
      if (Math.abs(deltaX) > Math.abs(deltaY)) {
        activeCard().style.transform = `translateX(${deltaX}px) rotate(${deltaX * 0.04}deg)`;
      }
    });
  });
});
