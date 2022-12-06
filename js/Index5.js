
let myChartAction = null;
let myChartCustomer = null;
let myChartRegional = null;
let myChartZona = null;
let myChartCategory = null;
let myChartIndustry = null;
let myChartSLA = null;
let myChartBranch = null;


function dashboard(cust ='', reg='' , dateStart =$('#date-start').val() , dateEnd=$('#date-end').val()) {
    $.ajax({
        url : 'action/data-dashboard.php',
        method :'post',
        dataType :'json',
        data : {
            cust:cust , reg:reg , dateStart:dateStart , dateEnd:dateEnd
        },
        success : function(data){
            console.log(data);
            $('#total-tiket').html(data.dataTiket.totalTiket);
            $('#total-open').html(data.dataTiket.OPEN);
            $('#total-solved').html(data.dataTiket.CLOSE);
            $('#total-progress').html(data.dataTiket.PROGRESS)
    
    
            const dataAct = data.dataAction
            const dataCust= data.dataCustomer
            const dataBran= data.dataBranch
            const dataReg= data.dataRegional
            const dataSL= data.dataSLA
            const dataZon= data.dataZona
            const dataCat= data.dataCategory
            const dataInd= data.dataIndustry
    

            const dataChartAction = dataAct.id
            const dataChartValAction = dataAct.value
            const dataAction = {
                labels: dataChartAction,
                datasets: [{
                    label: 'My First Dataset',
                    data: dataChartValAction,
                    backgroundColor: [
                        '#ef4444',
                        '#2D9CDB',
                        '#F8961E',
                        '#F9C74F',
                        '#90BE6D',
                        '#F3722C'
                    ],
                }]
            };
    
            const configAction = {
                type: 'doughnut',
                data: dataAction,
                options: {
                    plugins: {
                        legend: {
                            position: 'right',
                        }
                    },
                    maintainAspectRatio: false,
                },
            };
                if(myChartAction!= null) {
                    myChartAction.destroy();
                }
                myChartAction = new Chart(
                document.getElementById('chart-action'),
                configAction
            )
            // End Chart Action 
    
            // Chart_customer
        const dataChartcustomer = dataCust.id
        const dataChartValCustomer = dataCust.value
        const dataCustomer = {
            labels: dataChartcustomer,
            datasets: [{
                label: 'Top 10 Customer Ticket',
                data: dataChartValCustomer,
                backgroundColor: [
                    'rgb(49, 46, 129)',
                    'rgb(55, 48, 163)',
                    'rgb(67, 56, 202)',
                    'rgb(79, 70, 229)',
                    'rgb(99, 102, 241)',
                    'rgb(129, 140, 248)',
                    'rgb(165, 180, 252)',
                    'rgb(199, 210, 254)',
                    'rgb(224, 231, 255)',
                    'rgb(238, 242, 255)'
                ],
            }]
        };
    
        const config = {
            type: 'bar',
            data: dataCustomer,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: "y",
                scales: {
                    y: {
                        ticks: {
                            font: {
                                size:9
                            },
                        },
                    },
                },
            },
        };
        if(myChartCustomer!= null) {
            myChartCustomer.destroy();
        }
    
        myChartCustomer = new Chart(
            document.getElementById('chart-customer'),
            config
        );
    
        // end Chart Customer
    
    
        // Chart Top 10 Branch
        const dataChartBranch = dataBran.id
        const dataChartValBranch = dataBran.value
        const dataBranch = {
            labels: dataChartBranch,
            datasets: [{
                label: 'Top 10 Branch Ticket',
                data: dataChartValBranch,
                backgroundColor: [
                    '#164e63',
                    '#155e75',
                    '#0e7490',
                    '#0891b2',
                    '#06b6d4',
                    '#22d3ee',
                    '#67e8f9',
                    '#a5f3fc',
                    '#cffafe',
                    '#ecfeff'
                ],
            }]
        };
    
        const configBranch = {
            type: 'bar',
            data: dataBranch,
            options: {
                plugins: {
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            font: {
                                size: 15
                            }
                        }
                    }
                },
                maintainAspectRatio: false,
                indexAxis: 'y',
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        };
        
        if(myChartBranch!= null) {
            myChartBranch.destroy();
        }
        myChartBranch = new Chart(
            document.getElementById('chart-branch'),
            configBranch
        );
    
        // Chart End Branch
    
        // Chart By Zona
        const dataChartZona = dataZon.id
        const dataChartValZona = dataZon.value
        const dataZona = {
            labels: dataChartZona,
            datasets: [{
                label: 'My First Dataset',
                data: dataChartValZona,
                hoverOffset: 4,
                backgroundColor: [
                    '#FFD700',
                    '#FF8C00',
                    '#FF4501',
                    '#FF6347',
                ],
            }]
        };
    
        const configZona = {
            type: 'doughnut',
            data: dataZona,
            options: {
                plugins: {
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            font: {
                                size: 15
                            },
                        },
                        position: 'bottom'
    
                    }
                },
                maintainAspectRatio: false,
            },
        };
        if(myChartZona!= null) {
            myChartZona.destroy();
        }
        myChartZona = new Chart(
            document.getElementById('chart-zona'),
            configZona
        );
        // End Chart By Zona
    
        // Chart By Category
        const dataChartCategory = dataCat.id
        const dataChartValCategory = dataCat.value
        const dataCategory = {
            labels: dataChartCategory,
            datasets: [{
                label: 'My First Dataset',
                data: dataChartValCategory,
                backgroundColor: [
                    '#FF6347',
                    '#FF9364',
                    'rgb(255, 205, 86)',
                    '#f97316'
                ],
            }]
        };
    
        const configCategory = {
            type: 'doughnut',
            data: dataCategory,
            options: {
                plugins: {
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            font: {
                                size: 12
                            },
                        },
                        position: 'bottom'
    
                    }
                },
                maintainAspectRatio: false,
            },
        };
        if(myChartCategory!= null) {
            myChartCategory.destroy();
        }
        myChartCategory = new Chart(
            document.getElementById('chart-category'),
            configCategory
        );
        // End Chart Category
    
    
        // Chart By SLA
        const dataChartSLA = dataSL.id
        const dataChartValSLA = dataSL.value
        const dataSLA = {
            labels: dataChartSLA,
            datasets: [{
                label: 'My First Dataset',
                data: dataChartValSLA,
                backgroundColor: [
                    '#FFD700',
                    '#FF4500',
                ],
            }]
        };
    
        const configSLA = {
            type: 'doughnut',
            data: dataSLA,
            options: {
                plugins: {
                    legend: {
                        position: 'right'
                    }
                },
                maintainAspectRatio: false,
            },
        };
        if(myChartSLA!= null) {
            myChartSLA.destroy();
        }
        myChartSLA = new Chart(
            document.getElementById('chart-sla'),
            configSLA
        )
    
        // end Chart SLA
    
    
    
    
        // Chart Industry 
        const ind = dataInd.id
        const indsVal = dataInd.value
        const dataIndustry = {
            labels: ind,
            datasets: [{
                    label: 'Open',
                    data: indsVal.OPEN,
                    backgroundColor: '#F94144'
                }, {
                    label: 'In-Proggress',
                    data: indsVal.PROGRESS,
                    backgroundColor: '#90BE6D'
                },
                {
                    label: 'Close',
                    data: indsVal.CLOSE,
                    backgroundColor: '#2D9CDB'
                }
            ]
        };
    
        const configIndustry = {
            type: 'bar',
            data: dataIndustry,
            options: {
                plugins: {
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            font: {
                                size: 12
                            }
                        },
                        position: 'bottom'
                    }
                },
                maintainAspectRatio: false,
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        };
    
        if(myChartIndustry!= null) {
            myChartIndustry.destroy();
        }
        myChartIndustry = new Chart(
            document.getElementById('chart-industry'),
            configIndustry
        );
    
        // End Industry 
    
        // Chart By Regional
    
        const reg = dataReg.id
        const regVal = dataReg.value
        const dataRegional = {
            labels: reg,
            datasets: [{
                    label: 'Open',
                    data: regVal.OPEN,
                    backgroundColor: '#8b5cf6'
                }, {
                    label: 'In-Proggress',
                    data: regVal.PROGRESS,
                    backgroundColor: '#FFD572'
                },
                {
                    label: 'Close',
                    data: regVal.CLOSE,
                    backgroundColor: '#ede9fe'
                }
            ]
        };
    
        const configRegional = {
            type: 'bar',
            data: dataRegional,
            options: {
                plugins: {
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            font: {
                                size: 12
                            }
                        },
                        position: 'bottom'
                    }
                },
                maintainAspectRatio: false,
                responsive: true,
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        beginAtZero: true,
                        stacked: true
                    }
                }
            },
        };
    
        if(myChartRegional!= null) {
            myChartRegional.destroy();
        }
        myChartRegional = new Chart(
            document.getElementById('chart-regional'),
            configRegional
        );
    
        }
    })
}

dashboard()

$('#customer , #regional , #date-start , #date-end').on('change', function (){
    const cust = $('#customer').val();
    const Reg = $('#regional').val();
    const dateStart = $('#date-start').val();
    const dateEnd = $('#date-end').val();
    dashboard(cust, Reg , dateStart , dateEnd)
})






    

   

    


   