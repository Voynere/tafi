$(document).ready(function(){
    $('.recom-faq > .recom-faq__item').each(function(){
        var blockText = $(this).find('.recom-faq__answer');
        var arrow = $(this).find('.arrow_open');
        
        $(this).click(function(){
            if(blockText.hasClass('hidden')){  // Проверка на наличие класса у блока текста
                blockText.removeClass('hidden');
                blockText.addClass('visible');
                arrow.addClass('active');
            } else {
                blockText.addClass('hidden');
                blockText.removeClass('visible');
                arrow.removeClass('active');
            }
        });
    });
});
