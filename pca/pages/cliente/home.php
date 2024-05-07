<?php
session_start();

if (!isset($_SESSION['logado'])) {
    header("Location: ../../index.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home | Cliente</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../dist /styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <script src="../../dist /apexcharts.min.js"></script>
    <script src="../../dist /jquery-3.3.1.min.js"></script>
    <script src="../../dist /axios.min.js"></script>
</head>

<body>
    <!--Container -->
    <div class="mx-auto bg-grey-400">
        <!--Screen-->
        <div class="min-h-screen flex flex-col">
            <!--Header Section Starts Here-->
            <header class="bg-nav">
                <div class="flex justify-between">
                    <div class="p-1 mx-3 inline-flex items-center">
                        <i class="fas fa-bars pr-2 text-white" onclick="sidebarToggle()"></i>
                        <h1 class="text-white p-2">Logo</h1>
                    </div>
                    <div class="p-1 flex flex-row items-center">
                        <img onclick="profileToggle()" class="inline-block h-8 w-8 rounded-full" src="../../profile.png" alt="">
                        <a href="#" onclick="profileToggle()" class="text-white p-2 no-underline hidden md:block lg:block"><?= $_SESSION['email'] ?></a>
                        <div id="ProfileDropDown" class="rounded hidden shadow-md bg-white absolute pin-t mt-12 mr-1 pin-r">
                            <ul class="list-reset">
                                <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">My account</a></li>
                                <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Notifications</a></li>
                                <li>
                                    <hr class="border-t mx-2 border-grey-ligght">
                                </li>
                                <li><a href="../../logout.php" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
            <!--/Header-->

            <div class="flex flex-1">
                <!--Sidebar-->
                <aside id="sidebar" class="bg-side-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block">

                    <ul class="list-reset flex flex-col">
                        <li class=" w-full h-full py-3 px-2 border-b border-light-border bg-white">
                            <a href="/cliente" class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fas fa-tachometer-alt float-left mx-2"></i>
                                Estatística de Consumo
                                <span><i class="fas fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class=" w-full h-full py-3 px-2 border-b border-light-border bg-white">
                            <a href="gastos.php" class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fas fa-table float-left mx-2"></i>
                                Tabela de Consumo
                                <span><i class="fas fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full py-3 px-2  bg-white">
                            <a href="#" class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="far fa-file float-left mx-2"></i>
                                Pages
                                <span><i class="fa fa-angle-down float-right"></i></span>
                            </a>
                            <ul class="list-reset -mx-2 bg-white-medium-dark">
                                <li class="border-t mt-2 border-light-border w-full h-full px-2 py-3">
                                    <a href="login.html" class="mx-4 font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                        Perfil
                                        <span><i class="fa fa-angle-right float-right"></i></span>
                                    </a>
                                </li>
                                <li class="border-t border-light-border w-full h-full px-2 py-3">
                                    <a href="register.html" class="mx-4 font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                        Notificações
                                        <span><i class="fa fa-angle-right float-right"></i></span>
                                    </a>
                                </li>
                                <li class=" w-full h-full py-3 px-2 border-b border-light-border bg-white">
                                    <a href="../../logout.php" class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                        <i class="fas fa-tachometer-alt float-left mx-2"></i>
                                        Logout
                                        <span><i class="fas fa-angle-right float-right"></i></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </aside>
                <!--/Sidebar-->

                <!-- Conteudo -->
                <!--Main-->
                <main class="bg-white-300 flex-1 p-3 overflow-hidden">

                    <div class="flex flex-col">

                        <!-- Card Sextion Starts Here -->
                        <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">

                            <!-- card -->

                            <div class="rounded overflow-hidden shadow bg-white mx-2 w-full">
                                <div class="px-6 py-2 border-b border-light-grey">
                                    <div class="font-bold text-xl">Gráficos</div>
                                </div>

                                <div class="flex">
                                    <div class="w-3/4 bg-gray-200 p-4">
                                        <!-- Conteúdo da primeira coluna -->
                                        <input type="date" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="txt_data" id="txt_data">
                                    </div>
                                    <div class="w-1/4 bg-gray-200 p-4 flex items-center justify-center"> <!-- Adicionando as classes flex, items-center e justify-center -->
                                        <!-- Conteúdo da segunda coluna -->
                                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="ver()">Atualizar</button> <!-- Estilizando o botão de acordo com o Tailwind CSS -->
                                    </div>
                                </div>


                                <div class="flex">

                                    <div class="w-full bg-gray-200 p-4">
                                        <!-- Conteúdo da primeira coluna -->
                                        <div id="grafico"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- /card -->

                        </div>
                        <!-- /Cards Section Ends Here -->

                    </div>
                </main>
                <!--/Main-->

            </div>
            <!--Footer-->
            <footer class="bg-grey-darkest text-white p-2">
                <div class="flex flex-1 mx-auto">&copy; Copyright 2024</div>
            </footer>
            <!--/footer-->
        </div>

        <script src="../../dist /main.js"></script>

        <script>
            let medida = []
            let intervalo = null
            let grafico = document.querySelector("#grafico")

            let chart = new ApexCharts(grafico, {
                chart: {
                    type: "area",
                    height: 450
                },
                series: [{
                        name: "volume",
                        data: medida
                    },
                    {
                        name: "Fluxo",
                        data: medida
                    }
                ],
                yaxis: {
                    min: 0,
                    max: 5
                },
            })
            chart.render()

            function ver() {
                let data = $("#txt_data").val()

                // Se data invalida
                if (data === "") {
                    window.alert("Entre com uma data válida")
                } else {
                    axios.post("http://localhost:8000/ajax/script.php", {
                            data: data
                        })
                        .then(function(response) {
                            chart.updateSeries([{
                                    data: response.data[0]
                                },
                                {
                                    data: response.data[1]
                                }
                            ])

                        })
                        .catch(function(error) {
                            console.log("Error: " + error)
                        })
                }
            }
        </script>
</body>

</html>