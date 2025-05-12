<?php require("vista/esquema/header.php"); ?>
<style>
    header h1 {
        margin: 0;
        font-size: 24px;
    }

    .organigrama {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
    }

    .nivel {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-bottom: 20px;
    }

    .cuadro {
        background: white;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 150px;
        text-align: center;
        padding: 10px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
    }

    .cuadro:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
    }

    .cuadro h3 {
        font-size: 14px;
        margin: 5px 0;
    }

    .cuadro p {
        font-size: 12px;
        color: #666;
    }

    .nivel-alcalde {
        margin-bottom: 40px;
    }

    .nivel-secretarios,
    .nivel-directores,
    .nivel-subalcaldes {
        flex-wrap: wrap;
        justify-content: center;
    }

    .nivel-secretarios .cuadro,
    .nivel-directores .cuadro,
    .nivel-subalcaldes .cuadro {
        width: 150px;
    }

    footer {
        background: #383838;
        color: white;
        text-align: center;
        padding: 10px 0;
        margin-top: 20px;
    }

    footer span {
        color: orange;
    }
</style>
<header>
    <h1>Organigrama Gobierno Autónomo Municipal de Challapata</h1>
</header>

<div class="organigrama">
    <!-- Nivel Alcalde -->
    <div class="nivel nivel-alcalde">
        <div class="cuadro">
            <h3>Alcalde Municipal</h3>
            <p>Marcos Choqueticlla Tito</p>
        </div>
    </div>

    <!-- Nivel Secretarios Municipales -->
    <div class="nivel nivel-secretarios">
        <div class="cuadro">
            <h3>Secretario de Desarrollo Productivo</h3>
            <p>Reddy</p>
        </div>
        <div class="cuadro">
            <h3>Secretario de Desarrollo Humano y Social</h3>
            <p>Hector Victoria</p>
        </div>
        <div class="cuadro">
            <h3>Secretario de Finanzas</h3>
            <p>W. Leniz</p>
        </div>
        <div class="cuadro">
            <h3>Secretario de Obras Públicas</h3>
            <p>Conde</p>
        </div>
    </div>

    <!-- Nivel Directores -->
    <div class="nivel nivel-directores">
        <div class="cuadro">
            <h3>Director Jurídico</h3>
            <p>Pedro Fernández</p>
        </div>
        <div class="cuadro">
            <h3>Director Administrativo</h3>
            <p>Sofía Torres</p>
        </div>
        <div class="cuadro">
            <h3>Director de Obras Públicas</h3>
            <p>Javier Quispe</p>
        </div>
        <div class="cuadro">
            <h3>Director de Catastro</h3>
            <p>Rosa Mendoza</p>
        </div>
    </div>

    <!-- Nivel Subalcaldes -->
    <div class="nivel nivel-subalcaldes">
        <div class="cuadro">
            <h3>Subalcalde Challapata</h3>
            <p>Mario Vargas</p>
        </div>
        <div class="cuadro">
            <h3>Subalcalde Qaqachaca</h3>
            <p>Laura Choque</p>
        </div>
        <div class="cuadro">
            <h3>Subalcalde Culta</h3>
            <p>Daniel Apaza</p>
        </div>
        <div class="cuadro">
            <h3>Subalcalde Aguas Calientes</h3>
            <p>Isabel Condori</p>
        </div>
        <div class="cuadro">
            <h3>Subalcalde Norte Condo</h3>
            <p>Fernando Mamani</p>
        </div>
        <div class="cuadro">
            <h3>Subalcalde Huancane</h3>
            <p>Carmen Limachi</p>
        </div>
        <div class="cuadro">
            <h3>Subalcalde Tolapalca</h3>
            <p>Rodrigo Quispe</p>
        </div>
        <div class="cuadro">
            <h3>Subalcalde Ancacato</h3>
            <p>Elena Huanca</p>
        </div>
        <div class="cuadro">
            <h3>Subalcalde De Norte condo Abajo</h3>
            <p>José Flores</p>
        </div>
    </div>
</div>

<?php require("vista/esquema/footeruni.php"); ?>
