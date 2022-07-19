function myFunction(x) {
    x.classList.toggle("change");
}

// JSC.Chart("chartDiv", {
//     series: [
//       {
//         points: [{ x: "A", y: 10 }, { x: "B", y: 5 }]
//       }
//     ]
//   });


function createGraph(a, b){
    var ctx = document.getElementById(a).getContext('2d');
    var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: Object.keys(b),
        datasets: [{
        steppedLine: false,

            label: 'Conversions Days',
            backgroundColor: 'white',
            borderColor: '#ffa810',
            data: Object.values(b)        
        }]
    },

    // Configuration options go here
    options: {
      scales: {
        xAxes: [{
            ticks: {
                display: false
            },
            gridLines: {
              display: false
            }
        }],
        yAxes: [{
                ticks: {
                    // Include a dollar sign in the ticks
                    // callback: function(value, index, values) {
                    //     return '$' + value;
                    // }
                    display: false
                },
                gridLines: {
                  display: false
                }

            }]
      }
    }
    });
}   


function searchUser() {
    var input, filter, div, li, a, i, txtValue;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    div = document.querySelector(".row");
    div_item = div.getElementsByClassName("col-md-4");
    for (i = 0; i < div_item.length; i++) {
        a = div_item[i].getElementsByTagName("h4")[0];
        txtValue = a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            div_item[i].style.display = "";
        } else {
            div_item[i].style.display = "none";
        }
    }
}


function sorting(d){
    let sort = d.value;
    let url = new URL(window.location.href);
    let search_param = url.searchParams;
    search_param.set('sort_by', sort);
    window.location.href = url;
}
