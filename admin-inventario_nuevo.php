<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario: Nuevo Material</title>


    <!-- Estilos CSS integrados directamente para evitar confusiones -->
    <style>
        /* Estilos CSS integrados directamente */
        /* General styles */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #d6dbdf;
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        h1, h2, h3 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
            font-weight: 300;
        }

        h1.titulo {
            font-size: 2em;
            margin-bottom: 30px;
        }

        .content-wrapper {
            display: flex;
            justify-content: center;
            padding: 40px;
        }

        .container-fluid {
            max-width: 1000px;
            background-color: #fff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .form-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-top: 20px;
        }

        .form-left, .form-right {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            background-color: #f9f9f9;
            color: #333;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .input-field:focus {
            border-color: #2980b9;
            background-color: #fff;
        }

        .textarea-field {
            width: 100%;
            height: 120px;
            resize: none;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            color: #333;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        img.foto {
            max-width: 200px;
            height: auto;
            margin: 10px auto;
            display: block;
            border-radius: 5px;
            border: 2px solid #ddd;
        }

        @media (max-width: 768px) {
            .form-wrapper {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            h1.titulo {
                font-size: 1.8em;
            }
        }

        .button-group {

            display: flex;
            justify-content: flex-start;
            gap: 20px;
        }

        .boton {
            display: inline-block;
            background-color: #2980b9;
            padding: 10px 15px;
            color: white;
            border: none;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .boton:hover {
            background-color: #3498db;
        }

        .boton.modificar {
            background-color: #27ae60;
        }

        .boton.modificar:hover {
            background-color: #2ecc71;
        }

        .boton.cancelar {
            background-color: #e74c3c;
        }

        .boton.cancelar:hover {
            background-color: #c0392b;
        }
        .form-left .input-field:last-of-type{
          margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <div class="container-fluid">
            <h1 class="titulo">Nuevo Material de Inventario</h1>
            <h3 class="titulo">AVISO: No utilizar comillas simples, dobles o algun otro caracter especial.</h3>
            <form action="inventario_proceso_agregar.php" method="POST" enctype="multipart/form-data">
                <div class="form-wrapper">
                    <!-- Columna Izquierda -->
                    <div class="form-left">
                        <strong><label for="n_resguardo" >Número de Resguardo:</label></strong>
                        <input type="text" class="input-field" id="n_resguardo" name="n_resguardo" required>

                        <strong><label for="codigo_material">Número de Inventario:</label></strong>
                        <input type="text" class="input-field" id="codigo_material" name="codigo_material" required>

                        <strong><label for="Tactivo">Tipo de Activo:</label></strong>
                        <input type="text" class="input-field" id="Tactivo" name="Tactivo" required>

                        <strong><label for="descripcion">Descripción:</label></strong>
                        <textarea class="textarea-field" id="descripcion" name="descripcion" required></textarea>

                        <strong><label for="Ubicacion1">Ubicación:</label></strong>
                        <select class="input-field" id="Ubicacion1" name="Ubicacion1" required>
                        <option value="Prestado" > cuernavaca</option>
                        <option value="CDMX" > CDMX</option>
                        <option value="Puebla" > Puebla</option>
                        <option value="Tijuana" > Tijuana</option>

                        </select>
                    </div>

                    <!-- Columna Derecha -->
                    <div class="form-right">
                        <strong><label for="ubicacion">Descripción de Observaciones:</label></strong>
                        <textarea class="textarea-field" id="ubicacion" name="ubicacion" required></textarea>

                        <strong><label for="foto">Agrega una foto:</label></strong>
                        <input type="file" class="input-field" id="foto" name="foto">

                        <strong><label for="fecha_alta">Fecha de alta:</label></strong>
                        <input type="date" class="input-field" id="fecha_alta" name="fecha_alta" required>
                    </div>
                </div>

                <div class="button-group">
                    <button type="submit" class="boton modificar">Agregar</button>
                    <a href="inventario.php" class="boton cancelar">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
