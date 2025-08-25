// Datos de autos
const autos = [
  { marca: "Toyota", modelo: "Corolla", precioARS: 40000000 },
  { marca: "Ford", modelo: "Fiesta", precioARS: 20000000 },
  { marca: "Chevrolet", modelo: "Onix", precioARS: 37000000 },
  { marca: "Renault", modelo: "Logan", precioARS: 19500000 },
  { marca: "Fiat", modelo: "Toro", precioARS: 36000000 },
  { marca: "Chevrolet", modelo: "Montana", precioARS: 30000000 },
  { marca: "Renault", modelo: "Kwid", precioARS: 19000000 },
  { marca: "Toyota", modelo: "Hilux", precioARS: 32000000 },
  { marca: "Volkswagen", modelo: "T-Cross", precioARS: 40000000 },
  { marca: "Chevrolet", modelo: "Tracker", precioARS: 28000000 }
];

// Cotización fija
const cotizacion = 1365;

const buscador = document.getElementById("buscador");
const listaAutos = document.getElementById("lista-autos");
const mensaje = document.getElementById("mensaje");

// Función para normalizar texto
function normalizar(texto) {
  return texto
    .toLowerCase()
    .normalize("NFD")                
    .replace(/[\u0300-\u036f]/g, "")   
    .replace(/[\u2010-\u2015]/g, "-")  
    .replace(/\s+/g, " ")              
    .trim();
}

// Función para renderizar autos
function mostrarAutos(arreglo) {
  listaAutos.innerHTML = "";
  mensaje.textContent = "";

  if (arreglo.length === 0) {
    mensaje.textContent = "⚠️ No se encontraron autos con ese criterio.";
    return;
  }

  arreglo.forEach(auto => {
    const li = document.createElement("li");
    const precioUSD = (auto.precioARS / cotizacion).toFixed(2);

    li.innerHTML = `
      <span>${auto.marca} ${auto.modelo}</span>
      <span class="precio">ARS ${auto.precioARS.toLocaleString()} ~ USD ${precioUSD}</span>
    `;
    listaAutos.appendChild(li);
  });
}

// Evento de filtrado en tiempo real
buscador.addEventListener("input", () => {
  const texto = normalizar(buscador.value);

  if (texto === "") {
    mostrarAutos(autos);
    return;
  }

  const filtrados = autos.filter(auto =>
    normalizar(auto.marca).includes(texto) ||
    normalizar(auto.modelo).includes(texto)
  );

  mostrarAutos(filtrados);
});

// Mostrar todos los autos al inicio
mostrarAutos(autos);