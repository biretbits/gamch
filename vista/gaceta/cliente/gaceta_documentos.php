
<?php require("vista/esquema/header.php"); ?>
<div class="banner-innerpage" style="background-image:url(/imagenes/gamch/fondo.jpg)">
    <div class="container">
    <!-- Row  -->
    <div class="row justify-content-center ">
    <!-- Column -->
    <div class="col-md-6 align-self-center text-center aos-init aos-animate" data-aos="fade-down" data-aos-duration="1200">
    <h1 class="title">GACETA MUNICIPAL</h1>
    <h6 class="subtitle op-8">Gobierno Autonomo Municipal de Challapata</h6>
    </div>
    <!-- Column -->
    </div>
    </div>
</div>
<?php
// Datos inventados
$documentos = [
    [
        'titulo' => 'Informe de Gestión 2023',
        'descripcion' => 'Resumen de actividades y resultados obtenidos durante la gestión municipal del año 2023.',
        'archivo' => 'informe_gestion_2023.pdf',
        'fecha' => '2024-01-15',
        'cod' => 'IG-2023'
    ],
    [
        'titulo' => 'Auditoría Interna - Julio 2023',
        'descripcion' => 'Reporte detallado de la auditoría interna realizada en el mes de julio.',
        'archivo' => 'auditoria_julio_2023.pdf',
        'fecha' => '2023-07-30',
        'cod' => 'AUD-0723'
    ],
    [
        'titulo' => 'Decreto Municipal N°012/2024',
        'descripcion' => 'Establece nuevas normas de circulación en la zona urbana de Challapata.',
        'archivo' => 'decreto_012_2024.pdf',
        'fecha' => '2024-02-05',
        'cod' => 'DM-012'
    ],
    [
        'titulo' => 'Resolución Administrativa N°045',
        'descripcion' => 'Aprobación del presupuesto para la gestión 2024.',
        'archivo' => 'resolucion_adm_045.pdf',
        'fecha' => '2024-03-01',
        'cod' => 'RA-045'
    ]
];

// Mostrar documentos
echo '<div class="container">
        <div class="row wrap-feature45-box">
            <div class="col-lg-12">
                <div class="row m-t-40 m-b-30" style="padding: 0px 6px;">';

foreach ($documentos as $doc) {
    echo '
        <div class="col-md-6 wrap-feature5-box buscar">
            <div class="card card-shadow" data-aos="fade-right" data-aos-duration="1200">
                <div class="card-body d-flex flex-wrap">
                    <div class="col-md-12 col-lg-9">
                        <h6 class="font-medium">'. $doc['titulo'] .'</h6>
                        <hr>
                        <p class="m-t-20" style="color: grey;">'. $doc['descripcion'] .'</p>
                    </div>
                    <div class="col-md-12 col-lg-3 text-center">
                        <a href="/archivos/'. $doc['archivo'] .'" target="_blank">
                            <img src="/imagenes/pdf.png" alt="PDF" style="max-width: 50px;">
                        </a>
                        <h6 style="font-size: 11px;" class="font-medium">'. $doc['fecha'] .'</h6>
                        <a href="/archivos/'. $doc['archivo'] .'" download="'. $doc['cod'] .'">
                            <i class="fa fa-download fa-2x" style="color: red;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>';
}

echo '      </div>
        </div>
    </div>
</div>';
?>



<?php require("vista/esquema/footeruni.php"); ?>
