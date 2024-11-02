$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#urlForm').submit(function (e) {
        e.preventDefault(); // Предотвращаем перезагрузку страницы

        let originalUrl = $('#url').val();
        $('#submitButton').prop('disabled', true); // Отключаем кнопку во время загрузки
        $('#buttonText').addClass('hidden'); // Скрываем текст кнопки
        $('#loading').removeClass('hidden'); // Показываем индикатор загрузки

        $.ajax({
            url: '/', // Убедитесь, что здесь указан ваш маршрут
            type: 'POST',
            data: {
                url: originalUrl,
            },
            success: function (response) {
                // Отображение короткой ссылки
                $('#result').html(`
                        <p class="text-3xl">Short link:
                            <a class="custom-short-link" href="${response.short_url}" target="_blank">${response.short_url}</a>
                            <button onclick="copyToClipboard('${response.short_url}')" class="custom-copy-button"><img src="${clipboardIconUrl}" alt="Copy" class="w-6 h-6"></button>
                        </p>
                    `);
            },
            error: function () {
                $('#result').html('<p>Something went wrong.</p>');
            },
            complete: function () {
                $('#submitButton').prop('disabled', false); // Включаем кнопку снова
                $('#buttonText').removeClass('hidden'); // Показываем текст кнопки
                $('#loading').addClass('hidden'); // Скрываем индикатор загрузки
            }
        });
    });
});
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('Link copied to clipboard!');
    }, function(err) {
        alert('Failed to copy text: ' + err);
    });
}
console.log("JavaScript подключен!");
