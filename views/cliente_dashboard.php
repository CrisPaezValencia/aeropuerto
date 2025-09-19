<?php
session_start();
if ($_SESSION['rol'] !== 'cliente') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cliente Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fff8f0;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: #fff;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: #ff9800;
            color: white;
        }

        tr:hover {
            background: #f1f1f1;
        }

        .logout {
            margin-top: 20px;
            display: inline-block;
        }

        .btn {
            padding: 8px 12px;
            background: #ff9800;
            color: white;
            border-radius: 4px;
            text-decoration: none;
        }

        .btn:hover {
            background: #e68900;
        }
    </style>
</head>

<body>
    <h2>👤 Panel del Cliente</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Número Vuelo</th>
            <th>Aerolínea</th>
            <th>Salida</th>
            <th>Llegada</th>
            <th>Puesto</th>
            <th>Estado</th>
        </tr>
        <?php foreach ($vuelos as $v): ?>
            <tr>
                <td><?= htmlspecialchars($v->getId()) ?></td>
                <td><?= htmlspecialchars($v->getNumero()) ?></td>
                <td><?= htmlspecialchars($v->getAerolinea()) ?></td>
                <td><?= htmlspecialchars($v->getFechaSalida()) ?></td>
                <td><?= htmlspecialchars($v->getFechaLlegada()) ?></td>
                <td><?= htmlspecialchars($v->getPuesto()) ?></td>
                <td><?= htmlspecialchars($v->getEstado()) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="/routes/logout.php" class="logout btn">Cerrar Sesión</a>
</body>

</html>