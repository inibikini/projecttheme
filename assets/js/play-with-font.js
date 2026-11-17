document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('[data-play-with-font]').forEach((component) => {
    const sample = component.querySelector('[data-play-with-font-sample]');
    const preview = component.querySelector('.play-with-font__preview');
    const controls = component.querySelectorAll('[data-play-with-font-control]');

    if (!sample || !preview || !controls.length) {
      return;
    }

    const fitSample = () => {
      sample.style.removeProperty('font-size');

      const availableWidth = sample.clientWidth;
      const sampleWidth = sample.scrollWidth;
      const baseFontSize = Number.parseFloat(window.getComputedStyle(sample).fontSize);

      if (availableWidth > 0 && sampleWidth > availableWidth) {
        sample.style.fontSize = `${baseFontSize * (availableWidth / sampleWidth)}px`;
      }
    };

    controls.forEach((control) => {
      control.addEventListener('click', () => {
        const isPressed = control.getAttribute('aria-pressed') === 'true';
        const pressed = !isPressed;

        control.setAttribute('aria-pressed', String(pressed));
        sample.classList.toggle(`play-with-font__sample--${control.dataset.playWithFontControl}`, pressed);
        fitSample();
      });
    });

    document.addEventListener('projecttheme:font-sample-change', fitSample);

    if (document.fonts) {
      document.fonts.ready.then(fitSample);
      document.fonts.addEventListener('loadingdone', fitSample);
    }

    if ('ResizeObserver' in window) {
      const resizeObserver = new ResizeObserver(fitSample);
      resizeObserver.observe(preview);
    } else {
      window.addEventListener('resize', fitSample);
    }

    fitSample();
  });
});
