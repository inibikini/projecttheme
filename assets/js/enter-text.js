document.addEventListener('DOMContentLoaded', () => {
  const inputs = document.querySelectorAll('[data-font-sample-input]');

  if (!inputs.length) {
    return;
  }

  const updateFontSamples = (value) => {
    document.querySelectorAll('[data-font-sample]').forEach((sample) => {
      const sampleValue = value || sample.dataset.originalText || '';
      sample.textContent = sample.closest('.font-box')
        ? sampleValue.slice(0, 4)
        : sampleValue;
    });

    document.dispatchEvent(new CustomEvent('projecttheme:font-sample-change', {
      detail: { text: value },
    }));
  };

  inputs.forEach((input) => {
    const section = input.closest('.enter-text');
    const initialText = input.value || section?.dataset.defaultText || '';

    document.querySelectorAll('[data-font-sample]').forEach((sample) => {
      if (!sample.dataset.originalText) {
        sample.dataset.originalText = sample.textContent;
      }
    });

    input.addEventListener('input', () => {
      updateFontSamples(input.value);
    });

    if (initialText) {
      updateFontSamples(initialText);
    }
  });
});
