<html>
    <head></head>
    <body>
        <section>
            <h1>Page Overview!</h1>
            <p>Description here..</p>
        </section>
        <section>
            <table>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->fname }}</td>
                            <td>{{ $user->role->name }}</td>
                            <td>{{ $user->page->url }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </body>
</html>
