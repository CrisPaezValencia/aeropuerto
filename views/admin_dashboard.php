<?php
session_start();
if ($_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #eef2f7;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h2 {
            color: #222;
            margin-bottom: 10px;
        }

        h3 {
            margin-top: 30px;
            color: #444;
        }

        .card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 20px;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            text-align: center;
        }

        th {
            background: #007bff;
            color: white;
            font-weight: 600;
        }

        tr:hover {
            background: #f9fbff;
        }

        .btn {
            padding: 8px 14px;
            background: #007bff;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: #0056b3;
            transform: translateY(-1px);
        }

        .btn-danger {
            background: #dc3545;
        }

        .btn-danger:hover {
            background: #a71d2a;
        }

        .btn-save {
            background: #28a745;
        }

        .btn-save:hover {
            background: #1e7e34;
        }

        .logout {
            margin-top: 20px;
            display: inline-block;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #ccc;
            margin-top: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        input[disabled],
        select[disabled] {
            background: #f5f5f5;
            border: 1px solid #ddd;
            color: #666;
        }

        form.create-user {
            display: flex;
            flex-direction: column;
            gap: 15px;
            max-width: 400px;
        }

        label {
            font-weight: 600;
            margin-bottom: 3px;
            display: block;
        }
    </style>
</head>

<body>
    <h2>👑 Panel de Administrador</h2>

    <div class="card">
        <h3>➕ Crear Usuario</h3>
        <form method="POST" action="create_user.php" class="create-user">
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div>
                <label for="clave">Clave:</label>
                <input type="password" id="clave" name="clave" required>
            </div>

            <div>
                <label for="rol">Rol:</label>
                <select id="rol" name="rol" required>
                    <option value="admin">Admin</option>
                    <option value="piloto">Piloto</option>
                    <option value="cliente">Cliente</option>
                </select>
            </div>

            <button type="submit" class="btn">Crear Usuario</button>
        </form>
    </div>

    <div class="card">
        <h3>Usuarios</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?= $u->getId() ?></td>
                    <td>
                        <form method="POST" action="update_user.php" class="row-form">
                            <input type="hidden" name="id" value="<?= $u->getId() ?>">
                            <input type="text" name="nombre" value="<?= htmlspecialchars($u->getNombre()) ?>" disabled>
                    </td>
                    <td>
                        <select name="rol" disabled>
                            <option value="admin" <?= $u->getRol() === 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="piloto" <?= $u->getRol() === 'piloto' ? 'selected' : '' ?>>Piloto</option>
                            <option value="cliente" <?= $u->getRol() === 'cliente' ? 'selected' : '' ?>>Cliente</option>
                        </select>
                    </td>
                    <td>
                        <button type="button" class="btn btn-edit">Editar</button>
                        <button type="submit" class="btn btn-save" style="display:none;">Guardar</button>
                        <a href="delete_user.php?id=<?= $u->getId() ?>" class="btn btn-danger">Eliminar</a>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="card">
        <h3>Vuelos</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Número</th>
                <th>Aerolínea</th>
                <th>Estado</th>
            </tr>
            <?php foreach ($vuelos as $v): ?>
                <tr>
                    <td><?= $v->getId() ?></td>
                    <td><?= $v->getNumero() ?></td>
                    <td><?= $v->getAerolinea() ?></td>
                    <td><?= $v->getEstado() ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <a href="/routes/logout.php" class="logout btn">Cerrar Sesión</a>

    <script>
        document.querySelectorAll(".btn-edit").forEach(btn => {
            btn.addEventListener("click", function() {
                const row = this.closest("tr");
                const inputs = row.querySelectorAll("input, select");

                inputs.forEach(el => el.disabled = false);

                row.querySelector(".btn-save").style.display = "inline-block";
                this.style.display = "none";
            });
        });
    </script>
</body>

</html>