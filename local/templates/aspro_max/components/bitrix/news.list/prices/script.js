document.addEventListener('DOMContentLoaded', function() {
    const sectionTitles = document.querySelectorAll('.price-list__section-title');

    sectionTitles.forEach(function(title) {
        title.addEventListener('click', function() {
            // Находим родительский элемент (саму секцию) и переключаем класс active
            const section = this.closest('.price-list__section');
            section.classList.toggle('active');
        });
    });
});

(function () {
    const input = document.getElementById('priceListSearch');
    const list = document.getElementById('priceList');
    const noResults = document.getElementById('priceListNoResults');

    input.addEventListener('input', function () {
        const query = this.value.trim().toLowerCase();
        const rows = list.querySelectorAll('.price-list__row');
        let totalVisible = 0;

        // Скрываем все контейнеры
        const allBlocks = list.querySelectorAll('.price-list__section, .price-list__subsection, .price-list__sub-subsection');
        allBlocks.forEach(block => block.style.display = 'none');

        rows.forEach(function (row) {
            const name = row.querySelector('.price-list__name').textContent.toLowerCase();
            const match = !query || name.includes(query);

            if (match) {
                row.style.display = '';
                totalVisible++;

                // Показываем под-подразделы (и глубже, если есть)
                const subSub = row.closest('.price-list__sub-subsection');
                if (subSub) subSub.style.display = '';

                // Показываем подразделы
                const sub = row.closest('.price-list__subsection');
                if (sub) sub.style.display = '';

                // Показываем корневые разделы
                const section = row.closest('.price-list__section');
                if (section) {
                    section.style.display = '';
                    // Если ввели текст поиска, автоматически раскрываем "аккордеон"
                    if (query) {
                        section.classList.add('active');
                    } else {
                        // При удалении текста поиска возвращаем аккордеон в закрытое состояние
                        section.classList.remove('active');
                    }
                }
            } else {
                row.style.display = 'none';
            }
        });

        noResults.style.display = totalVisible === 0 ? '' : 'none';
    });
})();