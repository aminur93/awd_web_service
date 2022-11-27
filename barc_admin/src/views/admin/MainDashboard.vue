<template>
    <div id="main_dashboard">
        <div class="info-data">
            <div class="small-box bg-info">
                <div class="head">
                    <div>
                        <h2>1500</h2>
                        <p>Farmers</p>
                    </div>
                    <div class="icon">
                        <i class='icon traffic'></i>
                    </div>
                </div>
                <a href="#" class="small-box-footer">View
                <i class="fas fa-arrow-circle-right">  </i>
                </a>
            </div>
            <div class="small-box bg-info1">
                <div class="head">
                    <div>
                        <h2>234</h2>
                        <p>Crops</p>
                    </div>
                    <div class="icon">
                        <i class='ion ion-bag'></i>
                    </div>
                </div>
                <a href="#" class="small-box-footer">View
                    <i class="fas fa-arrow-circle-right">  </i>
                </a>
            </div>
            <div class="small-box bg-info2">
                <div class="head">
                    <div>
                        <h2>465</h2>
                        <p>Department</p>
                    </div>
                    <div class="icon">
                        <i class='ion ion-bag'></i>
                    </div>
                </div>
                <a href="#" class="small-box-footer">View
                    <i class="fas fa-arrow-circle-right">  </i>
                </a>
            </div>
            <div class="small-box bg-info3">
                <div class="head">
                    <div>
                        <h2>235</h2>
                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <font-awesome-icon icon="fa-solid fa-traffic-cone" />
                    </div>
                </div>
                <a href="#" class="small-box-footer">View
                    <i class="fas fa-arrow-circle-right">  </i>
                </a>
            </div>
        </div>


        <div class="data">
            <div class="content-data">
                <div class="head">
                    <h3>Reports Charts</h3>
                </div>
                <div class="chart">
                    <div id="chart"></div>
                </div>
            </div>

            <div class="content-data">
                <div class="head">
                    <h3>Data Report</h3>
                </div>
                <div class="chart">
                    <div id="chart"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MainDashboard"
    }
</script>

<style scoped>

</style>