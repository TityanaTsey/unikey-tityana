const map = L.map('map').setView([31.9865, 35.8714], 16);

L.tileLayer('https://{s}.tile.thunderforest.com/transport/{z}/{x}/{y}{r}.png?apikey={apikey}', {
    attribution: '&copy; <a href="http://www.thunderforest.com/">Thunderforest</a>, &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    apikey: '6eb394707edd47e7a75125281e232875',
    maxZoom: 22
}).addTo(map);

const colors = {
    faculty: '#3b82f6',
    library: '#ef4444',
    mosque: '#10b981',
    restroom: '#a855f7',
    cafeteria: '#f59e0b',
    parking: '#6b7280',
    admin: '#14b8a6',
    lecture: '#6366f1',
    health: '#dc2626'
};

let routingControl = null;
let currentPosition = null;
let locationMarker = null;
let locationErrorShown = false;

// Create layer group for all markers
const markersLayer = L.layerGroup().addTo(map);
const allMarkers = [];

// Get Font Awesome icon for each type
function getIconForType(type) {
    const icons = {
        'library': 'fa-book',
        'faculty': 'fa-graduation-cap',
        'mosque': 'fa-mosque',
        'restroom': 'fa-restroom',
        'cafeteria': 'fa-utensils',
        'admin': 'fa-building',
        'health': 'fa-hospital',
        // 'parking': 'fa-square-parking',
        // add sakant and inventories
        'dormitory': 'fa-chalkboard-user'
    };
    return icons[type] || 'fa-map-marker-alt';
}
const locations = [
    // 📚 Libraries
    {
        name: "Main Library (Central)",
        coords: [32.015684, 35.869952],
        type: "library",
        icon: "🏛️"
      },
      {
        name: "Law Faculty Reading Hall",
        coords: [32.014400, 35.870500],
        type: "library",
        icon: "⚖️"
      },
      {
        name: "Medical Library",
        coords: [32.016200, 35.872000],
        type: "library",
        icon: "🩺"
      },
      {
        name: "Engineering Reading Hall",
        coords: [32.015100, 35.875600],
        type: "library",
        icon: "🛠️"
      },
      {
        name: "Pharmacy Reading Hall",
        coords: [32.015900, 35.873400],
        type: "library",
        icon: "💊"
      },
      {
        name: "Science Faculty Reading Hall",
        coords: [32.015500, 35.874800],
        type: "library",
        icon: "🔬"
      },
      {
        name: "Agriculture Reading Hall",
        coords: [32.016300, 35.875700],
        type: "library",
        icon: "🌿"
      },
      {
        name: "Sharia Reading Hall",
        coords: [32.014600, 35.873200],
        type: "library",
        icon: "📖"
      },
      {
        name: "Business Reading Hall",
        coords: [32.015300, 35.874000],
        type: "library",
        icon: "📊"
      },
      {
        name: "Foreign Languages Reading Hall",
        coords: [32.014900, 35.873900],
        type: "library",
        icon: "🌍"
      },
      {
        name: "Educational Sciences Reading Hall",
        coords: [32.014700, 35.874300],
        type: "library",
        icon: "📚"
      },
      {
        name: "Graduate Studies Library",
        coords: [32.015400, 35.872900],
        type: "library",
        icon: "🎓"
      },    

    // 🏫 Faculties
    {
        name: "King Abdullah II School of Information Technology",
        coords: [32.0170, 35.8694],
        type: "faculty",
        icon: "💻"
    },
    {
        name: "Faculty of Medicine",
        coords: [32.015505, 35.874839],
        type: "faculty",
        icon: "🩺"
      },
      {
        name: "Faculty of Engineering",
        coords: [32.014800, 35.875300],
        type: "faculty",
        icon: "🏗️"
      },
      {
        name: "Faculty of Arts",
        coords: [32.014200, 35.874700],
        type: "faculty",
        icon: "🎨"
      },
      {
        name: "Faculty of Science",
        coords: [32.015000, 35.875000],
        type: "faculty",
        icon: "🧪"
      },
      {
        name: "Faculty of Business",
        coords: [32.015600, 35.873900],
        type: "faculty",
        icon: "💼"
      },
      {
        name: "Faculty of Law",
        coords: [32.014600, 35.873800],
        type: "faculty",
        icon: "⚖️"
      },
      {
        name: "Faculty of Pharmacy",
        coords: [32.015300, 35.874500],
        type: "faculty",
        icon: "💊"
      },
      {
        name: "Faculty of Nursing",
        coords: [32.015800, 35.874200],
        type: "faculty",
        icon: "👩‍⚕️"
      },
      {
        name: "Faculty of Agriculture",
        coords: [32.016000, 35.875600],
        type: "faculty",
        icon: "🌾"
      },
      {
        name: "Faculty of Sharia",
        coords: [32.014500, 35.873500],
        type: "faculty",
        icon: "🕌"
      },
      {
        name: "Faculty of Educational Sciences",
        coords: [32.014900, 35.874200],
        type: "faculty",
        icon: "📘"
      },
      {
        name: "Faculty of Physical Education",
        coords: [32.016200, 35.875800],
        type: "faculty",
        icon: "🏋️"
      },
      {
        name: "Faculty of Foreign Languages",
        coords: [32.015100, 35.873700],
        type: "faculty",
        icon: "🈯"
      },
      {
        name: "Faculty of Graduate Studies",
        coords: [32.015400, 35.874000],
        type: "faculty",
        icon: "🎓"
      },
    

    // 🕌 Mosques
    {
        name: "University Mosque",
        coords: [32.0178459, 35.8667938],
        type: "mosque",
        icon: "🕌"
      },
      {
        name: "Faculty of Sharia Prayer Room",
        coords: [32.0145, 35.8735],
        type: "mosque",
        icon: "🕌"
      },
      {
        name: "Faculty of Engineering Prayer Room",
        coords: [32.0148, 35.8753],
        type: "mosque",
        icon: "🕌"
      },
      {
        name: "Faculty of Science Prayer Room",
        coords: [32.0150, 35.8750],
        type: "mosque",
        icon: "🕌"
      },
      {
        name: "Faculty of Medicine Prayer Room",
        coords: [32.0155, 35.8748],
        type: "mosque",
        icon: "🕌"
      },
      {
        name: "Faculty of Business Prayer Room",
        coords: [32.0156, 35.8739],
        type: "mosque",
        icon: "🕌"
      },
      {
        name: "Faculty of Law Prayer Room",
        coords: [32.0146, 35.8738],
        type: "mosque",
        icon: "🕌"
      },
      {
        name: "Faculty of Pharmacy Prayer Room",
        coords: [32.0153, 35.8745],
        type: "mosque",
        icon: "🕌"
      },
      {
        name: "Faculty of Nursing Prayer Room",
        coords: [32.0158, 35.8742],
        type: "mosque",
        icon: "🕌"
      },
      {
        name: "Faculty of Agriculture Prayer Room",
        coords: [32.0160, 35.8756],
        type: "mosque",
        icon: "🕌"
      },
      {
        name: "Faculty of Educational Sciences Prayer Room",
        coords: [32.0149, 35.8742],
        type: "mosque",
        icon: "🕌"
      },
      {
        name: "Faculty of Physical Education Prayer Room",
        coords: [32.0162, 35.8758],
        type: "mosque",
        icon: "🕌"
      },
      {
        name: "Faculty of Foreign Languages Prayer Room",
        coords: [32.0151, 35.8737],
        type: "mosque",
        icon: "🕌"
      },
      {
        name: "Faculty of Graduate Studies Prayer Room",
        coords: [32.0154, 35.8740],
        type: "mosque",
        icon: "🕌"
      },
      {
        name: "King Abdullah II School of Information Technology Prayer Room",
        coords: [32.0170, 35.8694],
        type: "mosque",
        icon: "🕌"
      },
    

    // 🚻 Restrooms
    {
        name: "حمامات كلية الآداب",
        coords: [32.015500, 35.870800],
        type: "restroom",
        icon: "🚻"
      },
      {
        name: "حمامات كلية العلوم",
        coords: [32.015700, 35.871000],
        type: "restroom",
        icon: "🚻"
      },
      {
        name: "حمامات كلية الهندسة",
        coords: [32.015900, 35.871200],
        type: "restroom",
        icon: "🚻"
      },
      {
        name: "حمامات كلية الطب",
        coords: [32.016100, 35.871400],
        type: "restroom",
        icon: "🚻"
      },
      {
        name: "حمامات كلية الصيدلة",
        coords: [32.016300, 35.871600],
        type: "restroom",
        icon: "🚻"
      },
      {
        name: "حمامات كلية التمريض",
        coords: [32.016500, 35.871800],
        type: "restroom",
        icon: "🚻"
      },
      {
        name: "حمامات كلية الأعمال",
        coords: [32.016700, 35.872000],
        type: "restroom",
        icon: "🚻"
      },
      {
        name: "حمامات كلية الشريعة",
        coords: [32.016900, 35.872200],
        type: "restroom",
        icon: "🚻"
      },
      {
        name: "حمامات كلية الزراعة",
        coords: [32.017100, 35.872400],
        type: "restroom",
        icon: "🚻"
      },
      {
        name: "حمامات كلية التربية الرياضية",
        coords: [32.017300, 35.872600],
        type: "restroom",
        icon: "🚻"
      },

    // ☕ Cafeterias
    {
        name: "Main Cafeteria",
        coords: [32.015190, 35.873880],
        type: "cafeteria",
        icon: "☕"
      },
      {
        name: "Engineering Cafeteria",
        coords: [32.014800, 35.875300],
        type: "cafeteria",
        icon: "🍽️"
      },
      {
        name: "Medical Cafeteria",
        coords: [32.015505, 35.874839],
        type: "cafeteria",
        icon: "🍴"
      },
      {
        name: "Science Cafeteria",
        coords: [32.015000, 35.875000],
        type: "cafeteria",
        icon: "🥗"
      },
      {
        name: "Business Cafeteria",
        coords: [32.015600, 35.873900],
        type: "cafeteria",
        icon: "🍛"
      },
      {
        name: "Law Cafeteria",
        coords: [32.014600, 35.873800],
        type: "cafeteria",
        icon: "🍕"
      },
      {
        name: "Pharmacy Cafeteria",
        coords: [32.015300, 35.874500],
        type: "cafeteria",
        icon: "🥪"
      },
      {
        name: "Nursing Cafeteria",
        coords: [32.015800, 35.874200],
        type: "cafeteria",
        icon: "🍲"
      },
      {
        name: "Agriculture Cafeteria",
        coords: [32.016000, 35.875600],
        type: "cafeteria",
        icon: "🌾"
      },
      {
        name: "Sharia Cafeteria",
        coords: [32.014500, 35.873500],
        type: "cafeteria",
        icon: "🍱"
      },
      {
        name: "Educational Sciences Cafeteria",
        coords: [32.014900, 35.874200],
        type: "cafeteria",
        icon: "🥘"
      },
      {
        name: "Physical Education Cafeteria",
        coords: [32.016200, 35.875800],
        type: "cafeteria",
        icon: "🥤"
      },
      {
        name: "Foreign Languages Cafeteria",
        coords: [32.015100, 35.873700],
        type: "cafeteria",
        icon: "🍜"
      },
      {
        name: "Graduate Studies Cafeteria",
        coords: [32.015400, 35.874000],
        type: "cafeteria",
        icon: "🍰"
      },
      {
        name: "Information Technology Cafeteria",
        coords: [32.0170, 35.8694],
        type: "cafeteria",
        icon: "💻"
      },
    
    // 🧭 Administrative Buildings
    {
        name: "مركز الاعتماد وضمان الجودة",
        coords: [32.015500, 35.869800],
        type: "admin",
        icon: "✅"
      },
      {
        name: "مركز تكنولوجيا المعلومات",
        coords: [32.015600, 35.870000],
        type: "admin",
        icon: "💻"
      },
      {
        name: "مركز الاستشارات والتدريب",
        coords: [32.015700, 35.870200],
        type: "admin",
        icon: "🎓"
      },
      {
        name: "مركز الدراسات الاستراتيجية",
        coords: [32.015800, 35.870400],
        type: "admin",
        icon: "📊"
      },
      {
        name: "مركز الابتكار والريادة",
        coords: [32.015900, 35.870600],
        type: "admin",
        icon: "🚀"
      },
      {
        name: "المركز الثقافي الإسلامي",
        coords: [32.016000, 35.870800],
        type: "admin",
        icon: "🕌"
      },
      {
        name: "مركز اللغات",
        coords: [32.016100, 35.871000],
        type: "admin",
        icon: "🗣️"
      },
      {
        name: "مركز تنمية وخدمة المجتمع",
        coords: [32.016200, 35.871200],
        type: "admin",
        icon: "🤝"
      },
      {
        name: "مركز الترجمة",
        coords: [32.016300, 35.871400],
        type: "admin",
        icon: "🌐"
      },
      {
        name: "مركز التميّز في التعلّم والتعليم",
        coords: [32.016400, 35.871600],
        type: "admin",
        icon: "🏅"
      },
      {
        name: "مركز المتطلبات الجامعية العامة",
        coords: [32.016500, 35.871800],
        type: "admin",
        icon: "📚"
      },
      {
        name: "دائرة اللوازم المركزية",
        coords: [32.016600, 35.872000],
        type: "admin",
        icon: "📦"
      },
      {
        name: "دائرة الهندسة",
        coords: [32.016700, 35.872200],
        type: "admin",
        icon: "🛠️"
      },
      {
        name: "دائرة خدمات الغذاء والتغذية",
        coords: [32.016800, 35.872400],
        type: "admin",
        icon: "🍽️"
      },
      {
        name: "دائرة التأمين الصحي",
        coords: [32.016900, 35.872600],
        type: "admin",
        icon: "🏥"
      },
      {
        name: "دائرة الموارد البشرية",
        coords: [32.017000, 35.872800],
        type: "admin",
        icon: "👥"
      },
      {
        name: "دائرة الشؤون القانونية",
        coords: [32.017100, 35.873000],
        type: "admin",
        icon: "⚖️"
      },
      {
        name: "دائرة صندوق إسكان العاملين",
        coords: [32.017200, 35.873200],
        type: "admin",
        icon: "🏠"
      },
      {
        name: "دائرة الصيانة",
        coords: [32.017300, 35.873400],
        type: "admin",
        icon: "🔧"
      },
      {
        name: "دائرة التدقيق الداخلي والمتابعة",
        coords: [32.017400, 35.873600],
        type: "admin",
        icon: "🔍"
      },
      {
        name: "دائرة الأمن الجامعي",
        coords: [32.017500, 35.873800],
        type: "admin",
        icon: "🛡️"
      },
      {
        name: "دائرة الخدمات المساندة",
        coords: [32.017600, 35.874000],
        type: "admin",
        icon: "🔧"
      },
      {
        name: "دائرة العطاءات المركزية",
        coords: [32.017700, 35.874200],
        type: "admin",
        icon: "📑"
      },
      {
        name: "مطبعة الجامعة الأردنية",
        coords: [32.017800, 35.874400],
        type: "admin",
        icon: "🖨️"
      },
      {
        name: "دائرة المحطات الزراعية",
        coords: [32.017900, 35.874600],
        type: "admin",
        icon: "🌾"
      },

    // 🏥 Health Center
    {
        name: "Jordan University Hospital",
        coords: [32.015684, 35.869952],
        type: "health",
        icon: "🏥"
      },
      {
        name: "University Health Center",
        coords: [32.015300, 35.870800],
        type: "health",
        icon: "🩺"
      },
      {
        name: "Dental Teaching Clinics",
        coords: [32.016000, 35.870500],
        type: "health",
        icon: "🦷"
      },
      {
        name: "Cell Therapy Center",
        coords: [32.015900, 35.871200],
        type: "health",
        icon: "🧬"
      },
    //سكنات
      {
        name: "سكن الأندلس للطالبات",
        coords: [32.015000, 35.869500],
        type: "dormitory",
        icon: "🏠"
      },
      {
        name: "سكن الزهراء للطالبات",
        coords: [32.015300, 35.869800],
        type: "dormitory",
        icon: "🏠"
      },
      {
        name: "سكن دانيا للطالبات",
        coords: [32.016000, 35.870500],
        type: "dormitory",
        icon: "🏠"
      },
      {
        name: "سكن الياسمين للطالبات",
        coords: [32.016300, 35.870800],
        type: "dormitory",
        icon: "🏠"
      },
      {
        name: "سكن بركات للطالبات",
        coords: [32.016600, 35.871100],
        type: "dormitory",
        icon: "🏠"
      },
      {
        name: "سكن الفيحاء للطالبات",
        coords: [32.017000, 35.871400],
        type: "dormitory",
        icon: "🏠"
      },
      {
        name: "سكن الباسم للطالبات",
        coords: [32.017300, 35.871700],
        type: "dormitory",
        icon: "🏠"
      },
      {
        name: "سكن بيت نيفين للطالبات",
        coords: [32.017600, 35.872000],
        type: "dormitory",
        icon: "🏠"
      },

];
// Create marker with popup
function createMarker(location) {
    const marker = L.marker(location.coords, {
        icon: L.divIcon({
            html: `<i class="fas ${getIconForType(location.type)}"></i>`,
            className: `custom-icon ${location.type}-icon`,
            iconSize: [30, 30]
        })
    }).bindPopup(`
        <div class="popup-content">
            <h4>${location.name}</h4>
            <p class="popup-type">${location.type.replace(/^\w/, c => c.toUpperCase())}</p>
            <div class="popup-actions">
                <button class="get-directions" data-lat="${location.coords[0]}" data-lng="${location.coords[1]}">
                    <i class="fas fa-route"></i> Get Directions
                </button>
                 <button class="save-location" data-lat="${location.coords[0]}" data-lng="${location.coords[1]}">
                    <i class="fas fa-bookmark"></i> Save Location
                </button>
            </div>
        </div>
    `);
    
    const circle = L.circleMarker(location.coords, {
        radius: 8,
        fillColor: colors[location.type] || '#888',
        color: '#fff',
        weight: 1,
        fillOpacity: 0.8
    });
    
    return { marker, circle };
}
// Initialize directions functionality
function setupDirections() {
    // Get user's current location
    map.locate({
        setView: false,
        maxZoom: 16,
        timeout: 10000,
        enableHighAccuracy: true
    });

    // Success handler
    map.on('locationfound', function(e) {
        currentPosition = e.latlng;
        locationErrorShown = false;
        
        // Remove previous location marker if exists
        if (locationMarker) {
            map.removeLayer(locationMarker);
        }
        
        locationMarker = L.marker(e.latlng, {
            icon: L.divIcon({
                html: '<i class="fas fa-location-dot"></i>',
                className: 'custom-icon user-location-icon',
                iconSize: [30, 30]
            }),
            zIndexOffset: 1000
        }).addTo(map).bindPopup("Your Current Location");
        
        document.getElementById('location-error').style.display = 'none';
    });

    // Error handler
    map.on('locationerror', function(e) {
        if (!locationErrorShown) {
            showLocationError("Location access denied. Please enable permissions.");
            locationErrorShown = true;
        }
    });

    // Handle direction requests
    document.addEventListener('click', function(e) {
        if (e.target.closest('.get-directions')) {
            handleDirectionRequest(e.target.closest('.get-directions'));
        }
    });
}
let currentRouteIndex = 0;
let routeWaypoints = [];

// Handle direction request
function handleDirectionRequest(button) {
    const destLat = parseFloat(button.dataset.lat);
    const destLng = parseFloat(button.dataset.lng);
    
    if (!currentPosition) {
        showLocationError("Getting your location...", true);
        map.locate({setView: false, maxZoom: 16});
        return;
    }
    
    // Set up waypoints for the route
    routeWaypoints = [
        currentPosition,
        L.latLng(destLat, destLng)
    ];
    
    currentRouteIndex = 0;
    calculateNextRoute();
    map.closePopup();
}

// Calculate and display the next segment of the route
function calculateNextRoute() {
    if (currentRouteIndex >= routeWaypoints.length - 1) {
        return; // No more segments to show
    }
    
    if (routingControl) {
        map.removeControl(routingControl);
    }
    
    const start = routeWaypoints[currentRouteIndex];
    const end = routeWaypoints[currentRouteIndex + 1];
    
    routingControl = L.Routing.control({
        waypoints: [start, end],
        routeWhileDragging: false,
        show: window.innerWidth > 768, // Only show by default on desktop
        collapsible: true,
        waypoints: [start, end],
        routeWhileDragging: false,
        showAlternatives: false,
        collapsible: true,
        addWaypoints: false,
        fitSelectedRoutes: true,
        lineOptions: {
            styles: [{color: '#006633', weight: 5}]
        },
        formatter: new L.Routing.Formatter({
            language: 'en',
            units: 'metric'
        }),
        createMarker: function() { return null; }
    }).addTo(map);
    
    // When this route is finished, show the next one
    routingControl.on('routesfound', function(e) {
        currentRouteIndex++;
        if (currentRouteIndex < routeWaypoints.length - 1) {
            // Add a small delay before showing the next route
            setTimeout(calculateNextRoute, 1000);
        }
    });
    const progress = document.createElement('div');
    progress.className = 'route-progress';
    progress.textContent = `Step ${currentRouteIndex + 1} of ${routeWaypoints.length - 1}`;
    document.body.appendChild(progress);
    progress.style.display = 'block';
    
    // When this route is finished, show the next one
    routingControl.on('routesfound', function(e) {
        currentRouteIndex++;
        if (currentRouteIndex < routeWaypoints.length - 1) {
            // Update progress
            progress.textContent = `Step ${currentRouteIndex + 1} of ${routeWaypoints.length - 1}`;
            // Add a small delay before showing the next route
            setTimeout(calculateNextRoute, 1000);
        } else {
            // All routes shown, remove progress
            progress.style.display = 'none';
            setTimeout(() => {
                document.body.removeChild(progress);
            }, 1000);
        }
    });
}

// Show location error/status
function showLocationError(message, isInfo = false) {
    const errorElement = document.getElementById('location-error');
    errorElement.textContent = message;
    errorElement.style.display = 'block';
    errorElement.style.background = isInfo ? '#f0f7f4' : '#ffebee';
    errorElement.style.color = isInfo ? '#006633' : '#dc2626';
    
    setTimeout(() => {
        if (errorElement.textContent === message) {
            errorElement.style.display = 'none';
        }
    }, 5000);
}

// Create all markers
locations.forEach(loc => {
    const { marker, circle } = createMarker(loc);
    allMarkers.push({ marker, circle, type: loc.type });
    markersLayer.addLayer(marker);
    markersLayer.addLayer(circle);
});

// Filter functionality
function filterMarkers() {
    const activeTypes = Array.from(document.querySelectorAll('.filter-btn.active'))
        .map(btn => btn.dataset.type);
    
    markersLayer.clearLayers();
    
    allMarkers.forEach(item => {
        if (activeTypes.includes(item.type)) {
            markersLayer.addLayer(item.marker);
            markersLayer.addLayer(item.circle);
        }
    });
}

// Initialize filter buttons
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        this.classList.toggle('active');
        filterMarkers();
    });
});

// Initialize
filterMarkers();
setupDirections();