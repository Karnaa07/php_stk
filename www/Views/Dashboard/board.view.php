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
                            <h3>Nombre de page</h3>
                            <h1>2.85k</h1>
                        </div>
                        <div class="card-progress">
                            <svg width="96" height="96" class="stroke-majenta">
                                <circle id="circle1" cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>17%</p>
                            </div>
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
                            <h3>Nombre d'article</h3>
                            <h1><?php echo $articleCount; ?></h1>
                        </div>
                        <div class="card-progress">
                            <svg width="96" height="96" class="stroke-cyan">
                                <circle id="circle1" cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>17%</p>
                            </div>
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
                            <h3>Nombre d'utilisateur</h3>
                            <h1><?php echo $userCount; ?></h1>
                        </div>
                        <div class="card-progress">
                            <svg width="96" height="96" class="stroke-majenta">
                                <circle id="circle1" cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>17%</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <small>Sur les 24 dernières heures</small>
                    </div>
                </div>
            </div>
        </div>

        <!--- TABLEAU DE VOYAGE --->

        <section class="recent-reservation">
            <div class="reserv-title">
                <h2 class="recent-reservation-title">Stats de progression</h2>
                <!-- <a href="#"class="show-title">Afficher tout</a> -->
            </div>
            <div class="charts">

                <div class="charts-card">
                    <p class="chart-title">Voyages</p>
                    <div id="bar-chart"></div>
                </div>

                <div class="charts-card">
                    <p class="chart-title">Voyages2</p>
                    <div id="place-chart"></div>
                </div>

            </div>
    </div>
</div>