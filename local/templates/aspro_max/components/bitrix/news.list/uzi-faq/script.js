document.addEventListener('DOMContentLoaded', function() {
    const titles = document.querySelectorAll('.recom-faq__title');

    titles.forEach(title => {
        title.addEventListener('click', function() {
            const answer = this.nextElementSibling;
            let svg = this.querySelector('.arrow_open');

            if (answer.classList.contains('hidden')) {
                answer.classList.remove('hidden');

                answer.style.display = 'block';
                const height = answer.scrollHeight + 28 + 'px';
                answer.style.height = '0';
                svg.style.transform = 'rotate(180deg)'
                setTimeout(() => {
                    answer.style.height = height;
                    answer.classList.add('visible');
                }, 10);

            } else {
                answer.style.height = answer.scrollHeight + 'px';
                svg.style.transform = 'rotate(0)'
                setTimeout(() => {
                    answer.style.height = '0';
                }, 20);
                answer.classList.remove('visible');

                setTimeout(() => {
                    answer.classList.add('hidden');
                }, 300);
            }
        });
    });
});