<html>
    <body>
        <form action="/send" method="post">
            @csrf
            <input type="text" name="name" placeholder="Имя" style="margin-bottom: 8px;"><br>
            <input type="text" name="email" placeholder="Электронная почта" style="margin-bottom: 8px;"><br>
            <input type="text" name="phone" placeholder="Номер телефона" style="margin-bottom: 8px;"><br>
            <input type="text" name="price" placeholder="Цена" style="margin-bottom: 8px;"><br>
            <input type="hidden" name="accountId" value="{{$accountId}}">
            <input type="submit" value="Создать сделку">
        </form>
    </body>
</html>
