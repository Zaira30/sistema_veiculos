
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>My Pharma 2GO - Vitaminas &amp; Suplementos dos EUA para sua casa!</title>


    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/blog/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.4/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="icon" href="https://d31vc84zd61nb4.cloudfront.net/media/favicon/default/01favcon_mp2go.png" type="image/x-icon" />
    <link rel="shortcut icon" href="https://d31vc84zd61nb4.cloudfront.net/media/favicon/default/01favcon_mp2go.png" type="image/x-icon" />
    <meta name="msapplication-config" content="https://getbootstrap.com/docs/4.4/assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">


    <style>
        @page {
            margin: 0;
        }
        * { padding: 0; margin: 0; }
        @font-face {
            font-family: "source_sans_proregular";
           /* src: local("Source Sans Pro"), url("fonts/sourcesans/sourcesanspro-regular-webfont.ttf") format("truetype");*/
            font-weight: normal;
            font-style: normal;
            font-size: 12px;

        }
        body{
            font-family: "source_sans_proregular", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;
        }


        .blog-footer {
            padding: 2.5rem 0;
            color: #999;
            text-align: center;
            background-color: #f9f9f9;
            border-top: .05rem solid #e5e5e5;
        }

        .dado {
            margin-top: 10px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .rodape{
            margin-left: 20px;
            font-weight: bold;
            font-size: 10px;
            color: #58595a;
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="blog.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">

            <table width="100%" style="margin-top: 5px">
                <thead>
                    <th></th>
                    <th style="text-align: center"> <img  src="{{public_path($parametro->file)}}" alt="MYPHARMA2GO"></th>
                    <th></th>
                </thead>
            </table>
        </div>
    </header>


    <div class="row dado">

        <table width="100%">
            <thead>
                <tr>
                    <td width="50%"><h5>ORÇAMENTO N° {{$budget->number_budget}}</h5></td>
                    <td width="20%"></td>
                    <td width="20%"></td>
                    <td> <h5>{{$budget->date}}</h5></td>
                </tr>

            </thead>
        </table>
    </div>

    <div class="row dado">

        <table width="100%">
                <thead>
                    <tr>
                        <td>PACIENTE: {{$budget->name}}</td>
                    </tr>

                    <tr>
                        <td>MÉDICO(A): {{$budget->doctor}}</td>
                    </tr>
                </thead>

        </table>
    </div>


    <div class="row mb-2">
        <div class="col-md-12">
            <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">

                <table class="table table-striped table-bordered table-hover">
                        <thead>
                                <tr>
                                    <th></th>
                                    <th style="text-align: center">Produto</th>
                                    <th style="text-align: center">Quantidade</th>
                                    <th style="text-align: center">Preço</th>
                                </tr>


                        </thead>

                        <tbody>

                        @foreach ($budget->budgetProduct as $row)

                            <?php
                                $frete = "R$ ".$parametro->freight;

                            if($budget->total > 300) {
                                $frete = "Grátis";
                             }

                            ?>
                                <tr>
                                        <td style="text-align: center"> <img width="35%" src="{{public_path($row->produto->file)}}" alt="{{$row->produto->name}}" style="width: 70px;display: block; margin-top: 14px;"></td>
                                        <td style="text-align:center;vertical-align:middle;">{{$row->produto->name}} <br>{{$row->produto->variation}}</td>
                                        <td style="text-align: center; vertical-align:middle;">{{$row->quantity}}</td>
                                        <td style="text-align: center; vertical-align:middle;">{{ number_format($row->produto->price,2,",",".") }}</td>
                                </tr>

                         @endforeach


                                <tr>
                                    <td></td>
                                    <td width="35%" style="text-align: center">Frete {{$frete}}</td>
                                    <td width="25%" style="text-align: center">Imposto {{$parametro->taxation}}%</td>
                                    <td width="50%" style="text-align: center">Total R$ {{$budget->total}}</td>
                                </tr>


                        </tbody>

                </table>

            </div>
        </div>
    </div>
</div>

<main role="main" class="container">
    <div class="row">


    </div><!-- /.row -->

</main><!-- /.container -->

<footer class="blog-footer">

    <div class="rodape">
        <?=$parametro->description?>
        <div style="margin-left: -40%">Qualquer dúvida estaremos à disposição. Entre em contato no nosso whats app: (11) 99868-0834.</div>
    </div>
</footer>
</body>
</html>
