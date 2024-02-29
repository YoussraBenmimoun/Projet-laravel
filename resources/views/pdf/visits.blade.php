<!DOCTYPE html>
<html>
<head>
    <title>Rapport des visites</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>Rapport des visites</h1>
    <p>Nombre total de visites : {{ $visitsCount }}</p>
    <table>
        <thead>
            <tr>
                <th>ID Utilisateur</th>
                <th>Date de la visite</th>
            </tr>
        </thead>
        <tbody>
            @foreach($visits as $visit)
            <tr>
                <td>{{ $visit->user_id ? $visit->user_id : "visiteur" }}</td>
                <td>{{ $visit->visited_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

