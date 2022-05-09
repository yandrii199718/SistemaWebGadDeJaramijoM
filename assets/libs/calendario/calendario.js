const date = new Date();

const renderCalendar = () => {
  date.setDate(1);

  const monthDays = document.querySelector(".days");

//dias que tiene el mes actual
  const lastDay = new Date(
    date.getFullYear(),
    date.getMonth() + 1,
    0
  ).getDate();


//dias que tiene el mes anterior
  const prevLastDay = new Date(
    date.getFullYear(),
    date.getMonth(),
    0
  ).getDate();

  const firstDayIndex = date.getDay();


  const lastDayIndex = new Date(
    date.getFullYear(),
    date.getMonth() + 1,
    0
  ).getDay();



  const nextDays = 7 - lastDayIndex - 1;

  const months = [
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre"
    ];

  year = date.getFullYear();
  month = date.getMonth()+1;

  document.querySelector(".date h1").innerHTML = months[date.getMonth()] + ' de '+ year;

  document.querySelector(".date p").innerHTML = new Date().toDateString();

  let days = "";


  for (let x = firstDayIndex; x > 0; x--) {
    days += `<div class="prev-date">${prevLastDay - x + 1}</div>`;
  }

  for (let i = 1; i <= lastDay; i++) {
    if (
      i === new Date().getDate() &&
      date.getMonth() === new Date().getMonth()
    ) {
      days += `<div class="today-month today"><div>${i}</div><div class="content"></div></div>`;
    } else {
      days += `<div class="today-month"><div>${i}</div><div class="content"></div></div>`;
    }
  }

  for (let j = 1; j <= nextDays; j++) {
    days += `<div class="next-date">${j}</div>`;
  }
  monthDays.innerHTML = days;

  eventTodayMonth();
  //showItems();


  return {
    'year': year,
    'month': month
  };
};


const eventTodayMonth = () => {
  var todayMonth = document.getElementsByClassName("today-month");

  for(i=0;i<todayMonth.length;i++){
      todayMonth[i].addEventListener("click",function(){
          //alert(month+ ' '+ this.innerHTML + ' '+ year);
          dayElement = this.firstElementChild.innerHTML //obtengo el dia clickiado

          elemento = this.lastElementChild;
          elemento = elemento.children; //childNodes
          for(var i=0;i<elemento.length;i++){
            var id = elemento[i].getAttribute('id');
            //console.log(id);
          }

          ajaxGetCronograma(dayElement, month, year);

      });
  }
}


// ejecutamos un ajax para mostrar en el cronograma
const ajaxCronograma = () => {
  var arrayDate = renderCalendar();
  var formData = new FormData();
  formData.append('year', arrayDate['year']);
  formData.append('month', arrayDate['month']);
  $.ajax({
    url: '/cronograma',
    type: 'post',
    method: 'post',
    data: formData,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (res) {
        showItems(res, year, month);
    }
  });
}


// ejecutamos un ajax para obtener los datos de un dia
const ajaxGetCronograma = (day, month, year) => {
  //var arrayDate = renderCalendar();
  var formData = new FormData();

  formData.append('year', year);
  formData.append('month', month);
  formData.append('day', day);

  $.ajax({
    url: '/getcronograma',
    type: 'post',
    method: 'post',
    data: formData,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (res) {

      const app = document.getElementById("eventos");
      app.innerHTML = "";
      app.innerHTML = "<h3>Cronograma</h3>";

      res.forEach((item, i) => {
      //  console.log(item);
        const div = document.createElement("div");
        const br = document.createElement("br");
        const hr = document.createElement("hr");
        div.textContent = `${item['nombres']} Tienes un mantenimiento ${item['tipo_mantenimiento']} programado para la fecha ${item['fecha_cronograma']}`;
        div.classList.add('evento');
        div.setAttribute('id', item['id_cronograma']);
        app.appendChild(div);
        app.appendChild(br);
        app.appendChild(hr);

        //colocar icono despues del text
        const icon = document.createElement("i");
        if(item.estadomantenimiento == 1 || item.estadomantenimiento == 2){
          if(rol != 'ADMINISTRADOR'){
            icon.classList.add('fas','fa-plus','fa-chart-area','icon-evento','btn-orden', 'ml-2');
            icon.setAttribute('id', item['id_cronograma']);
          }
        } else {
          icon.classList.add('fas','fa-eye','fa-chart-area','icon-evento','btn-ver-orden', 'ml-2');
          icon.setAttribute('data-id', item['idorden']);
        }

        div.appendChild(icon);
      });

    }
  });
}

function showItems(arrayFilters, year, month) {

  var content = document.getElementsByClassName("content");
  if (content.length) {
    for (i = 0; i < content.length; i++) {
      day = content[i].innerHTML = '';
    }
  }

  if (Array.isArray(arrayFilters) && arrayFilters.length != 0) {
    arrayFilters.forEach(function (element, index) {
      if (year == element.year && month == element.month) {

        //alert('hola este si es el año y mes');
        var todayMonth = document.getElementsByClassName("today-month");

        for (i = 0; i < todayMonth.length; i++) {
          dayElement = todayMonth[i].firstElementChild.innerHTML;
          if (element.day == dayElement) {

            day = todayMonth[i].lastElementChild;
            var p = document.createElement("p");
            if (element.estadomantenimiento == 1) {
              p.classList.add('pendiente');
            } else if (element.estadomantenimiento == 2) {
              p.classList.add('vencido');
            } else {
              p.classList.add('finalizado');
            }
            p.setAttribute('id', element.id_cronograma);
            day.appendChild(p);
            //day.classList.add('pendiente');
          }
        }
      }
    });
  }
}


document.querySelector(".prev").addEventListener("click", () => {
  date.setMonth(date.getMonth() - 1);
  ajaxCronograma();
});



document.querySelector(".next").addEventListener("click", () => {
  date.setMonth(date.getMonth() + 1);
  ajaxCronograma();
});
renderCalendar();
