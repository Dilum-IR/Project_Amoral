<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <h1 class="title">Reports</h1>
            <!-- <p class="subtitle"  style="margin-bottom:10px">Generate a report for your land</p> -->


            <div class="report-container">
                <div class="report-img">
                    <div class="gen-area">

                        <p class="form-input-title">Select Date Range:</p>
                        <input type="date" name="start_date" id="start_date" onchange="selectDate()" style="color: #8a8a8a;" />
                        <input type="date" name="end_date" id="end_date" onchange="selectDate()" style="color: #8a8a8a;" />

                        <p class="text-warning" id="message"></p>
                        <!-- <button class="gen-btn" id="gen" onclick="generatePDF()"><a class="gen-btn" href="<?php // echo URLROOT 
                                                                                                                ?>/report/viewReport/2"></a>Generate Report</button> -->
                        <button class="gen-btn" id="gen" onclick="generatePDF()">Generate Report</button>



                        <button class="view-btn" id="view" onclick="viewPDF()" style="display: none;">View</button>
                        <button class="download-btn" id="down" onclick="downloadBlob()" style="display: none;">Download</button>
                    
                    </div>
                </div>

                <div class="report-des">
                    <h1 class="title">How to Generate</h1>
                    <h1 class="title" style="color: #626262; transform: translateY(-35px)">Your Report</h1>

                    <div class="report-ins">
                        <ul>
                            <li>Select the parking you want to get the Report</li>
                            <li>Select the preferred date range for the Report</li>
                            <li>Click “Generate Report”</li>
                            <li>Report will be Automatically Generated</li>
                            <li>Use Adobe PDF Viewer or any other suitable software to view the report</li>
                            <li>Click “Download” to download the report</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="https://unpkg.com/jspdf-invoice-template@latest/dist/index.js" type="text/javascript"></script>

<script>
    let lands = [];
    var backendData = 5 <?php // echo json_encode($data['lands']); 
                        ?>;

    // lands = backendData.map(land => {
    //     return { id: land.id, name: land.name, car: land.car, bike: land.bike, threeWheel: land.threeWheel, city: land.city};
    // });

    console.log(lands)

    //pdf generate code
    //Generate pdf
    var pdfObject; //outputType: jsPDFInvoiceTemplate.OutputType.Blob,

    landId = null;
    genarateData = null;
    data_length = null;
    var sDate = null;
    var eDate = null;
    var total = null;

    function selectPark(chooseId) {

        landId = chooseId;
        return landId;
        // console.log(landId);
    }

    function selectDate() {

        sDate = document.getElementById('start_date').value;
        eDate = document.getElementById('end_date').value;

    }

    /* generate pdf */

    function generatePDF() {

        
        document.getElementById('message').textContent = 'Your report is generated!';
        document.getElementById('gen').style.display = 'none';
        document.getElementById('view').style.display = 'inline-block';
        document.getElementById('down').style.display = 'inline-block';


        // $.ajax({
        //     url: 'report/viewReport',
        //     method: 'POST',
        //     data: { landID: landId ,startDate : sDate , endDate:eDate},
        //     success: function (response) {
        //         res =JSON.parse(response);

        //         genarateData = res;
        //         data_length = genarateData.length;
        //         console.log(landId);
        //         console.log(sDate);
        //         console.log(eDate);
        //         console.log("genarateData:", genarateData);



        for (let i = 0; i < data_length; i++) {
            total += 10
            // parseFloat(genarateData[i]['cost']);
        }


        var props = {
            outputType: jsPDFInvoiceTemplate.OutputType.Blob,
            returnJsPDFDocObject: true,
            fileName: "Invoice 2024",
            orientationLandscape: false,
            compress: true,
            logo: {
                src: "http://localhost/project_Amoral/public/assets/images/logo.JPG",
                type: 'PNG',
                width: 30,
                height: 30,
                margin: {
                    top: 0,
                    left: 0
                }
            },
            stamp: {
                inAllPages: true,
                src: "https://raw.githubusercontent.com/edisonneza/jspdf-invoice-template/demo/images/qr_code.jpg",
                type: 'JPG',
                width: 30,
                height: 30,
                margin: {
                    top: -10,
                    left: 0
                }
            },
            business: {
                name: "Amoral",
                address: "Akurassa, Matara, Sri Lanka.",
                phone: "+9477 620 2215",
                email: "amoral639@gmail.com",
                website: "www.amoral.lk",
            },
            contact: {
                label: "",
                name: "Monthly Revenue Report",
                address: "Employee ID : 5432",
                phone: "071258634 ",
                email: "Genarated Date : 2024/04/21",
                otherInfo: "\n\n",
            },
            invoice: {
                label: "",
                num: 19,
                invDate: "From Date : 6532",
                invGenDate: "To Date : 523\n\n",
                headerBorder: false,
                tableBodyBorder: false,
                style: {
                    margin: {
                        top: 100
                    },
                },
                header: [{
                        title: "#",
                        style: {
                            width: 10,
                            height: 100,
                            backgroundColor: '#f2f2f2',
                            textAlign: 'center',
                            fontWeight: 'bold',
                        }
                    },

                    {
                        title: "Order ID",
                        style: {
                            width: 25,

                        }
                    },
                    {
                        title: "Customer ID",
                        style: {
                            width: 25,

                        }
                    },
                    {
                        title: "Placed Date",
                        style: {
                            width: 30,

                        }
                    },
                    {
                        title: "Delivered Date",
                        style: {
                            width: 30,

                        }
                    },
                    {
                        title: "Quantity",
                        style: {
                            width: 25,

                        }
                    },
                    {
                        title: "Cost(Rs.)",
                        style: {
                            width: 30,

                        }
                    },
                    {
                        title: "Total(Rs.)",
                        style: {
                            width: 20,

                        }
                    },

                ],
                table: Array.from(Array(5), (item, index) => ([
                    "\n" + index + 1,
                    "\nORD-" + 1235 + "\n",
                    "\nUSR-" + 387,
                    "\n2024-12-15",
                    "\n2024-12-30",
                    "\n" + 50 + "\n",
                    "\n5082.00 \n",
                    "\n5082.00",
                    // "\n"+ genarateData[index]['driverID']+"\n",
                    // genarateData[index]['vehicleType'],
                    // genarateData[index]['startTime'],
                    // genarateData[index]['endTime'],
                    // // (genarateData[index]['status'] === 0) ? 'IN' : 'OUT' ,
                    // ((new Date(genarateData[index]['endTime']).getTime() - new Date(genarateData[index]['startTime']).getTime()) / (1000 * 60 * 60)).toFixed(2),
                    // genarateData[index]['cost'],
                    // (genarateData[index]['paymentStatus'] === 0) ? 'payed' : 'unpaid' 

                ])),

                additionalRows: [{
                        col1: '\tNet Total  :',
                        col2: '\t\t\t',
                        col3: '542.00',
                        style: {
                            fontSize: 12
                        }
                    },
                    {
                        col1: '\tTotal Cost :',
                        col2: '\t\t\t',
                        col3: '542.00',
                        style: {
                            fontSize: 12,
                            margin: {
                                top: 10,
                                bottom: 15,
                            }
                        }
                    },
                    {
                        col1: '\tNet Profit :',
                        col2: '\t\t\t',
                        col3: '52535.00',
                        style: {
                            fontSize: 14
                        }
                    }
                ],
                // invDescLabel: "Invoice Note",
                // invDesc: "There are many variations of passages of Lorem Ipsum available, " +
                //     "but the majority have suffered alteration in some form, by injected humour," +
                //     "or randomised words which don't look even slightly believable. If you are going" +
                //     "to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing " +
                //     "hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat" +
                //     " predefined chunks as necessary.",
            },
            footer: {
                text: "The invoice is created on a computer and is valid without the signature and stamp.",
            },
            pageEnable: true,
            pageLabel: "Page ",
        };
        pdfObject = jsPDFInvoiceTemplate.default(props);
        console.log("Object generated: ", pdfObject);


        // },
        // error: function (xhr, status, error) {
        // console.error("AJAX error:", xhr.responseText);
        // }
        // });


    }

    /* view pdf */
    function viewPDF() {
        console.log("genarateData:", genarateData);
        console.log(pdfObject);
        if (!pdfObject) {
            return console.log('No PDF Object');
        }

        var fileURL = URL.createObjectURL(pdfObject.blob);
        window.open(fileURL, '_blank');
    }

    /* download pdf */
    function downloadBlob() {
        if (!pdfObject) {
            return console.log('No PDF Object');
        }

        const fileURL = URL.createObjectURL(pdfObject.blob);
        const link = document.createElement('a');
        link.href = fileURL;
        link.download = "Invoice" + new Date() + ".pdf";
        link.click();
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>