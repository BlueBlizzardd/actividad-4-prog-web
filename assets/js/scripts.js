const btn = document.querySelector('.chart');
const responseStatus = document.querySelector(".status");
const ctx = document.getElementById('myChart');

const myChart = new Chart(ctx, {
    type: 'line',
    data: {},
    options: {
        scales: {
            x: { 
                type: 'time',
                title: {
                    display: true,
                    text: 'Date'
                },
                beginAtZero: false
            },
            y: {
                title: {
                    display: true,
                    text: 'PSI'
                },
            }
        }
    }
})

btn.addEventListener("click", (e) => {

    const state = document.querySelector('#state').value;

    $.ajax({
        type: "POST",
        url: 'assets/php/select.php',
        dataType: "json",
        data: { state: state },
        beforeSend: function() {
            console.log("Waiting for response...");
        },
        success: function(resp) {
            const unique = resp.map(item => item.well).filter((value, index, self) => self.indexOf(value) === index);
            console.log(unique);

            myChart.data = {
                datasets: unique.map(elem => ({
                    label: elem,
                    data: resp.filter(obj => obj.well === elem).map(obj => ({
                        x: obj.date,
                        y: obj.psi
                    }))  
                }))
            }

            myChart.update();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            responseStatus.innerHTML = `${textStatus, errorThrown}`;
        }
    });
});