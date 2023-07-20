<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="dashboard-container">
    <div class="main-container">
        <h1 class="main-title">Dashboard</h1>

        <!-- card -->
        <div class="insights">
            <div class="card">
                <div class="card-container">
                    <div class="card-header">
                        <span class="material-icons-sharp">bar_chart</span>
                    </div>
                    <div class="card-body">
                        <div class="card-info">
                            <h3>Pages</h3>
                            <h1><?php echo $pageCount; ?></h1>
                        </div>
                        <div class="card-progress">
                            <svg width="96" height="96" class="stroke-majenta">
                                <circle id="circle1" cx="38" cy="38" r="36"></circle>
                            </svg>
                        </div>
                    </div>
                    <div class="card-footer">
                        <small>Sur les 24 dernières heures</small>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-container">
                    <div class="card-header">
                        <span class="material-icons-sharp">bar_chart</span>
                    </div>
                    <div class="card-body">
                        <div class="card-info">
                            <h3>Articles</h3>
                            <h1><?php echo $articleCount; ?></h1>
                        </div>
                        <div class="card-progress">
                            <svg width="96" height="96" class="stroke-cyan">
                                <circle id="circle1" cx="38" cy="38" r="36"></circle>
                            </svg>
                        </div>
                    </div>
                    <div class="card-footer">
                        <small>Sur les 24 dernières heures</small>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-container">
                    <div class="card-header">
                        <span class="material-icons-sharp">bar_chart</span>
                    </div>
                    <div class="card-body">
                        <div class="card-info">
                            <h3>Users</h3>
                            <h1><?php echo $userCount; ?></h1>
                        </div>
                        <div class="card-progress">
                            <svg width="96" height="96" class="stroke-majenta">
                                <circle id="circle1" cx="38" cy="38" r="36"></circle>
                            </svg>
                        </div>
                    </div>
                    <div class="card-footer">
                        <small>Sur les 24 dernières heures</small>
                    </div>
                </div>
            </div>
        </div>

        <!--- CHARTS FOR PROGRESSION STATS --->
        <h1 class="main-title">Progression</h1>
        <div style="display: flex; justify-content: space-between; width: 850px;">
            <div style="width: 400px;">
                <canvas id="myBarChart"></canvas>
            </div>

            <div style="width: 400px;">
                <canvas id="myPieChart"></canvas>
            </div>
        </div>

        <script>
            // Données pour le graphique à barres
            const labelsBar = ['Jan', 'Fev', 'Mar', 'Avr', 'Mai'];
            const dataBar = [15, 22, 30, 18, 25];

            // Configuration du graphique à barres
            const configBar = {
                type: 'bar',
                data: {
                    labels: labelsBar,
                    datasets: [{
                        label: 'Voyages mensuels sur le site',
                        data: dataBar,
                        backgroundColor: 'rgba(54, 162, 235, 0.8)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            };

            // Créer le graphique à barres
            const myBarChart = new Chart(
                document.getElementById('myBarChart'),
                configBar
            );

            // Données aléatoires pour le graphique camembert
            const inscrits = Math.floor(Math.random() * 100);
            const nonInscrits = Math.floor(Math.random() * 100);

            // Configuration du graphique camembert
            const configPie = {
                type: 'doughnut',
                data: {
                    labels: ['Inscrits', 'Non inscrits'],
                    datasets: [{
                        data: [inscrits, nonInscrits],
                        backgroundColor: ['rgba(54, 162, 235, 0.8)', 'rgba(255, 99, 132, 0.8)'],
                        borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            };

            // Créer le graphique camembert
            const myPieChart = new Chart(
                document.getElementById('myPieChart'),
                configPie
            );
        </script>