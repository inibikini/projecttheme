document.addEventListener('DOMContentLoaded', () => {
  const sections = document.querySelectorAll('.filter-section');

  if (!sections.length) {
    return;
  }

  const storageKey = 'projecttheme-color-mode';

  const cookieMode = document.cookie.match(/(?:^|; )projecttheme_color_mode=(dark|light)(?:;|$)/);
  const storedMode = localStorage.getItem(storageKey) || (cookieMode && cookieMode[1]);
  const getInitialMode = () => {
    if (storedMode === 'light' || storedMode === 'dark') {
      return storedMode;
    }
    return sections[0].dataset.defaultMode === 'light' ? 'light' : 'dark';
  };

  const setColorMode = (mode) => {
    document.documentElement.dataset.colorMode = mode;
    localStorage.setItem(storageKey, mode);
    document.cookie = `projecttheme_color_mode=${mode};path=/;max-age=${60 * 60 * 24 * 365};SameSite=Lax`;

    sections.forEach((section) => {
      section.querySelector('.filter-section__mode-input').checked = mode === 'light';
    });
  };

  const initialMode = getInitialMode();
  setColorMode(initialMode);

  sections.forEach((section) => {
    section.querySelectorAll('.filter-section__category').forEach((button) => {
      button.addEventListener('click', () => {
        const wasSelected = button.getAttribute('aria-pressed') === 'true';
        const selectedValue = wasSelected ? '' : button.dataset.filterValue;

        section.querySelectorAll('.filter-section__category').forEach((categoryButton) => {
          categoryButton.setAttribute('aria-pressed', String(categoryButton === button && !wasSelected));
        });

        document.querySelectorAll('[data-font-category], [data-filter-category]').forEach((item) => {
          const itemCategories = `${item.dataset.fontCategory || ''} ${item.dataset.filterCategory || ''}`
            .split(/[\s,]+/)
            .filter(Boolean);

          item.classList.toggle('filter-section__item-hidden', Boolean(selectedValue) && !itemCategories.includes(selectedValue));
        });

        document.dispatchEvent(new CustomEvent('projecttheme:font-filter-change', {
          detail: { category: selectedValue || null },
        }));
      });
    });

    const modeInput = section.querySelector('.filter-section__mode-input');
    modeInput.addEventListener('change', () => {
      setColorMode(modeInput.checked ? 'light' : 'dark');
    });
  });
});
