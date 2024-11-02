
<script>
    $(document).ready(function () {
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
                    _token: '{{ csrf_token() }}' // CSRF-токен для безопасности
                },
                success: function (response) {
                    // Отображение короткой ссылки
                    $('#result').html(`
                        <p class="text-3xl">Short link:
                            <a class="text-blue-500" href="${response.short_url}" target="_blank">${response.short_url}</a>
                            <button onclick="copyToClipboard('${response.short_url}')" class="ml-2 p-2 text-white bg-blue-100 rounded hover:bg-blue-200"><img src="{{ asset('images/clipboard.svg') }}" alt="Copy" class="w-6 h-6"></button>
                        </p>
                    `);
                },
                error: function (xhr) {
                    if (xhr.status === 429) {
                        $('#result').html('<p class="text-red-500">You have exceeded the request limit. Try again after 1 minute.</p>');
                    } else {
                        $('#result').html('<p>Something went wrong.</p>');
                    }
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
            // Показываем сообщение
            const alertBox = $('#copyAlert');
            alertBox.removeClass('hidden'); // Показываем элемент
            alertBox.css('transform', 'translateY(0)'); // Сброс трансформации для появления

            // Скрываем сообщение через 2 секунды
            setTimeout(function() {
                alertBox.css('transform', 'translateY(-10px)'); // Поднимаем сообщение вверх
                setTimeout(function() {
                    alertBox.addClass('hidden'); // Скрываем элемент
                }, 300); // Ждем анимацию перед скрытием
            }, 2000); // Пауза перед скрытием (2 секунды)
        }, function(err) {
            alert('Failed to copy text: ' + err);
        });
    }
</script>
