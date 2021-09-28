<html>
    <head></head>
    <body>
        <section>
            <h1>Role Overview!</h1>
            <p>Description here..</p>
        </section>
        <section>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Amount of users</th>
                        <th>Hierarchy</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->description }}</td>
                            <td>{{ $role->userAmount() }}</td>
                            <td>{{ $role->role_number }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </body>
</html>
