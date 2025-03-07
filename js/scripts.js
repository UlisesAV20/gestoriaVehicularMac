/*!
* Start Bootstrap - Shop Homepage v5.0.6 (https://startbootstrap.com/template/shop-homepage)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-shop-homepage/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project

// Custom JS for scroll-to-top behavior
document.addEventListener('DOMContentLoaded', function () {
    const scrollToTopButton = document.getElementById('scrollToTopButton');
  
    // Mostrar u ocultar el botón basado en la posición del scroll
    window.addEventListener('scroll', function () {
      if (window.scrollY > 300) {
        scrollToTopButton.style.display = 'flex'; // Cambiado a 'flex' para mantener la alineación centrada
        scrollToTopButton.style.opacity = '1';
        scrollToTopButton.style.visibility = 'visible';
      } else {
        scrollToTopButton.style.opacity = '0';
        scrollToTopButton.style.visibility = 'hidden';
        scrollToTopButton.style.display = 'none';
      }
    });
  
    // Desplazamiento suave hacia arriba
    scrollToTopButton.addEventListener('click', function (e) {
      e.preventDefault();
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  });
  
  
  function htmlExcel(idTabla, nombreArchivo = '') {
      let tablaDatos = document.getElementById(idTabla);
      let hoja = [];
  
      // Obtener encabezados
      let encabezados = [];
      for (let th of tablaDatos.getElementsByTagName('thead')[0].getElementsByTagName('th')) {
          encabezados.push(th.innerText);
      }
      hoja.push(encabezados);
  
      // Obtener datos de la tabla
      for (let tr of tablaDatos.getElementsByTagName('tbody')[0].getElementsByTagName('tr')) {
          let fila = [];
          for (let td of tr.getElementsByTagName('td')) {
              fila.push(td.innerText);
          }
          hoja.push(fila);
      }
  
      // Crear libro de Excel
      let libro = XLSX.utils.book_new();
      let hojaExcel = XLSX.utils.aoa_to_sheet(hoja);
      XLSX.utils.book_append_sheet(libro, hojaExcel, 'Hoja1');
  
      // Nombre del archivo
      nombreArchivo = nombreArchivo ? nombreArchivo + '.xlsx' : 'Reporte_Inventario.xlsx';
  
      // Descargar archivo
      XLSX.writeFile(libro, nombreArchivo);
  }
  