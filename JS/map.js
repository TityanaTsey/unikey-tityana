const map = L.map('map').setView([32.015112943536764, 35.8727421420314], 15);

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
    health: '#dc2626',
    warehouse: '#2a2420',
    housing: '#4a5d3d'
};

let routingControl = null;
let currentPosition = null;
let locationMarker = null;
let locationErrorShown = false;


// Create layer group for all markers
const markersLayer = L.layerGroup().addTo(map);
const allMarkers = [];

function getIconForType(type) {
    const icons = {
        'library': 'fa-book',
        'faculty': 'fa-graduation-cap',
        'mosque': 'fa-mosque',
        'restroom': 'fa-restroom',
        'cafeteria': 'fa-utensils',
        'admin': 'fa-building',
        'health': 'fa-hospital',
        'parking': 'fa-square-parking',
        'warehouse': 'fa-warehouse',
        'housing': 'fa-house',
    };
    return icons[type] || 'fa-map-marker-alt';
}

const locations = [
  // 📚 Libraries
  {
      name: "Main Library (Central)",
      coords: [32.01548221185544, 35.86989139944726],
      type: "library",
      icon: "🏛️",
      description: "المكتبة الرئيسية (المركزية)"
    },
    {
      name: "Law Faculty Reading Hall",
      coords: [32.01893230457874, 35.87245649119323],
      type: "library",
      icon: "⚖️",
      description: "قاعة مطالعة كلية القانون"
    },
    {
      name: "Medical Library",
      coords: [32.0087565425114, 35.874988152589985],
      type: "library",
      icon: "🩺",
      description: "المكتبة الطبية"
    },
    {
      name: "Engineering Reading Hall",
      coords: [32.01060481470905, 35.87607209693808],
      type: "library",
      icon: "🛠️",
      description: "قاعة مطالعة كلية الهندسة"
    },
    {
      name: "Pharmacy Reading Hall",
      coords: [32.00845132367584, 35.876250784046576],
      type: "library",
      icon: "💊",
      description: "قاعة مطالعة كلية الصيدلة"
    },
    {
      name: "Science Faculty Reading Hall",
      coords: [32.013380511398665, 35.873417705123934],
      type: "library",
      icon: "🔬",
      description: "قاعة مطالعة كلية العلوم"
    },
    {
      name: "Agriculture Reading Hall",
      coords: [32.01177218870231, 35.873830617348126],
      type: "library",
      icon: "🌿",
      description: "قاعة مطالعة كلية الزراعة"
    },
    {
      name: "Sharia Reading Hall",
      coords: [32.0181466346324, 35.87371408818547],
      type: "library",
      icon: "📖",
      description: "قاعة مطالعة كلية الشريعة"
    },
    {
      name: "Business Reading Hall",
      coords: [32.017952191025806, 35.87128630066829],
      type: "library",
      icon: "📊",
      description: "قاعة مطالعة كلية الأعمال"
    },
    {
      name: "Foreign Languages Reading Hall",
      coords: [32.01715195657032, 35.870102281807824],
      type: "library",
      icon: "🌍",
      description: "قاعة مطالعة كلية اللغات الأجنبية"
    },
    {
      name: "Educational Sciences Reading Hall",
      coords: [32.02006006293124, 35.87108908514441],
      type: "library",
      icon: "📚",
      description: "قاعة مطالعة كلية العلوم التربوية"
    },

  // 🏫 Faculties
  {
      name: "King Abdullah II School of Information Technology",
      coords: [32.0141240739917, 35.87301555222812],
      type: "faculty",
      icon: "💻",
      description: "كلية الملك عبدالله الثاني لتكنولوجيا المعلومات"
  },
  {
      name: "Faculty of Medicine",
      coords: [32.00925169881052, 35.87470885879635],
      type: "faculty",
      icon: "🩺",
      description: "كلية الطب"
    },
    {
      name: "Faculty of Engineering",
      coords: [32.01065855166421, 35.87597775238769],
      type: "faculty",
      icon: "🏗️",
      description: "كلية الهندسة"
    },
    {
      name: "Faculty of Arts",
      coords: [32.006809236358286, 35.87758235693826],
      type: "faculty",
      icon: "🎨",
      description: "كلية الآداب"
    },
    {
      name: "Faculty of Science",
      coords: [32.01347562004348, 35.87337158767819],
      type: "faculty",
      icon: "🧪",
      description: "كلية العلوم"
    },
    {
      name: "Faculty of Business",
      coords: [32.01787202555375, 35.87135811744215],
      type: "faculty",
      icon: "💼",
      description: "كلية الأعمال"
    },
    {
      name: "Faculty of Law",
      coords: [32.018697555991906, 35.872425636621514],
      type: "faculty",
      icon: "⚖️",
      description: "كلية القانون"
    },
    {
      name: "Faculty of Pharmacy",
      coords: [32.00809395297376, 35.87613936136166],
      type: "faculty",
      icon: "💊",
      description: "كلية الصيدلة"
    },
    {
      name: "Faculty of Nursing",
      coords: [32.00821394905431, 35.875644997472584],
      type: "faculty",
      icon: "👩‍⚕️",
      description: "كلية التمريض"
    },
    {
      name: "Faculty of Agriculture",
      coords: [32.01160644009547, 35.87384462769313],
      type: "faculty",
      icon: "🌾",
      description: "كلية الزراعة"
    },
    {
      name: "Faculty of Sharia",
      coords: [32.017376964887774, 35.872478365051066],
      type: "faculty",
      icon: "🕌",
      description: "كلية الشريعة"
    },
    {
      name: "Faculty of Educational Sciences",
      coords: [32.02001164747517, 35.870974441007135],
      type: "faculty",
      icon: "📘",
      description: "كلية العلوم التربوية"
    },
    {
      name: "Faculty of Physical Education",
      coords: [31.984420529831983, 35.91058914526577],
      type: "faculty",
      icon: "🏋️",
      description: "كلية التربية الرياضية"
    },
    {
      name: "Faculty of Foreign Languages",
      coords: [32.017142618095725, 35.870085691203016],
      type: "faculty",
      icon: "🈯",
      description: "كلية اللغات الأجنبية"
    },
    {
      name: "Faculty of Graduate Studies",
      coords: [32.01127083089933, 35.87176649315116],
      type: "faculty",
      icon: "🎓",
      description: "كلية الدراسات العليا"
    },
  

  // 🕌 Mosques
  {
      name: "University Mosque",
      coords: [32.0177982280539, 35.866838881642224],
      type: "mosque",
      icon: "🕌",
      description: "مسجد الجامعة"
    },
    {
      name: "Faculty of Sharia Prayer Room",
      coords: [32.017376964887774, 35.872478365051066],
      type: "mosque",
      icon: "🕌",
      description: "مصلى كلية الشريعة"
    },
    {
      name: "Faculty of Engineering Prayer Room",
      coords: [32.01065855166421, 35.87597775238769],
      type: "mosque",
      icon: "🕌",
      description: "مصلى كلية الهندسة"
    },
    {
      name: "Faculty of Science Prayer Room",
      coords: [32.01341452031573, 35.87344875769614],
      type: "mosque",
      icon: "🕌",
      description: "مصلى كلية العلوم"
    },
    {
      name: "Faculty of Medicine Prayer Room",
      coords: [32.00925169881052, 35.87470885879635],
      type: "mosque",
      icon: "🕌",
      description: "مصلى كلية الطب"
    },
    {
      name: "Faculty of Business Prayer Room",
      coords: [32.01786045488823, 35.87136713244716],
      type: "mosque",
      icon: "🕌",
      description: "مصلى كلية الأعمال"
    },
    {
      name: "Faculty of Law Prayer Room",
      coords: [32.01869098538282, 35.87242569606264],
      type: "mosque",
      icon: "🕌",
      description: "مصلى كلية القانون"
    },
    {
      name: "Faculty of Pharmacy Prayer Room",
      coords: [32.0086636553078, 35.876243974553645],
      type: "mosque",
      icon: "🕌",
      description: "مصلى كلية الصيدلة"
    },
    {
      name: "Faculty of Nursing Prayer Room",
      coords: [32.00823622213194, 35.87565882307921],
      type: "mosque",
      icon: "🕌",
      description: "مصلى كلية التمريض"
    },
    {
      name: "Faculty of Agriculture Prayer Room",
      coords: [32.011634823135964, 35.87394375283401],
      type: "mosque",
      icon: "🕌",
      description: "مصلى كلية الزراعة"
    },
    {
      name: "Faculty of Educational Sciences Prayer Room",
      coords: [32.02000703478084, 35.870959228691035],
      type: "mosque",
      icon: "🕌",
      description: "مصلى كلية العلوم التربوية"
    },
    {
      name: "Faculty of Physical Education Prayer Room",
      coords: [31.984412098591992, 35.91052682535786],
      type: "mosque",
      icon: "🕌",
      description: "مصلى كلية التربية الرياضية"
    },
    {
      name: "Faculty of Foreign Languages Prayer Room",
      coords: [32.017135701813146, 35.87009325605691],
      type: "mosque",
      icon: "🕌",
      description: "مصلى كلية اللغات الأجنبية"
    },
    {
      name: "Faculty of Graduate Studies Prayer Room",
      coords: [32.011215710351784, 35.87175242405362],
      type: "mosque",
      icon: "🕌",
      description: "مصلى كلية الدراسات العليا"
    },
    {
      name: "King Abdullah II School of Information Technology Prayer Room",
      coords: [32.014087685316404, 35.87300482339274],
      type: "mosque",
      icon: "🕌",
      description: "مصلى كلية الملك عبدالله الثاني لتكنولوجيا المعلومات"
    },
  

  // 🚻 Restrooms
  {
      name: "حمامات كلية الآداب",
      coords: [32.017515316608915, 35.87027859166615],
      type: "restroom",
      icon: "🚻",
      description: "حمامات كلية الآداب"
    },
    {
      name: "حمامات كلية العلوم",
      coords: [32.013387596553414, 35.87341657407303],
      type: "restroom",
      icon: "🚻",
      description: "حمامات كلية العلوم"
    },
    {
      name: "حمامات كلية الهندسة",
      coords: [32.01059822283634, 35.875949182526774],
      type: "restroom",
      icon: "🚻",
      description: "حمامات كلية الهندسة"
    },
    {
      name: "حمامات كلية الطب",
      coords: [32.00889368657979, 35.87463578440603],
      type: "restroom",
      icon: "🚻",
      description: "حمامات كلية الطب"
    },
    {
      name: "حمامات كلية الصيدلة",
      coords: [32.008224859151326, 35.87620130938169],
      type: "restroom",
      icon: "🚻",
      description: "حمامات كلية الصيدلة"
    },
    {
      name: "حمامات كلية التمريض",
      coords: [32.00820430050478, 35.875652882429584],
      type: "restroom",
      icon: "🚻",
      description: "حمامات كلية التمريض"
    },
    {
      name: "حمامات كلية الأعمال",
      coords: [32.01784802270472, 35.87136011886916],
      type: "restroom",
      icon: "🚻",
      description: "حمامات كلية الأعمال"
    },
    {
      name: "حمامات كلية الشريعة",
      coords: [32.017389199669985, 35.87246993827138],
      type: "restroom",
      icon: "🚻",
      description: "حمامات كلية الشريعة"
    },
    {
      name: "حمامات كلية الزراعة",
      coords: [32.01180459233821, 35.87384402054795],
      type: "restroom",
      icon: "🚻",
      description: "حمامات كلية الزراعة"
    },
    {
      name: "حمامات كلية التربية الرياضية",
      coords: [31.984404406043204, 35.91053011333217],
      type: "restroom",
      icon: "🚻",
      description: "حمامات كلية التربية الرياضية"
    },

  // ☕ Cafeterias
  {
      name: "مطعم الجامعة",
      coords: [32.01499565234304, 35.87099852691798],
      type: "cafeteria",
      icon: "☕",
      description: "مطعم الجامعة"
    },
    {
      name: "Engineering Cafeteria",
      coords: [32.014800, 35.875300],
      type: "cafeteria",
      icon: "🍽️",
      description: "مطعم كلية الهندسة"
    },
    {
      name: "Medical Cafeteria",
      coords: [32.015505, 35.874839],
      type: "cafeteria",
      icon: "🍴",
      description: "مطعم كلية الطب"
    },
    {
      name: "Science Cafeteria",
      coords: [32.015000, 35.875000],
      type: "cafeteria",
      icon: "🥗",
      description: "مطعم كلية العلوم"
    },
    {
      name: "Business Cafeteria",
      coords: [32.015600, 35.873900],
      type: "cafeteria",
      icon: "🍛",
      description: "مطعم كلية الأعمال"
    },
    {
      name: "Law Cafeteria",
      coords: [32.014600, 35.873800],
      type: "cafeteria",
      icon: "🍕",
      description: "مطعم كلية القانون"
    },
    {
      name: "Pharmacy Cafeteria",
      coords: [32.015300, 35.874500],
      type: "cafeteria",
      icon: "🥪",
      description: "مطعم كلية الصيدلة"
    },
    {
      name: "Nursing Cafeteria",
      coords: [32.015800, 35.874200],
      type: "cafeteria",
      icon: "🍲",
      description: "مطعم كلية التمريض"
    },
    {
      name: "Agriculture Cafeteria",
      coords: [32.016000, 35.875600],
      type: "cafeteria",
      icon: "🌾",
      description: "مطعم كلية الزراعة"
    },
    {
      name: "Sharia Cafeteria",
      coords: [32.014500, 35.873500],
      type: "cafeteria",
      icon: "🍱",
      description: "مطعم كلية الشريعة"
    },
    {
      name: "Educational Sciences Cafeteria",
      coords: [32.014900, 35.874200],
      type: "cafeteria",
      icon: "🥘",
      description: "مطعم كلية العلوم التربوية"
    },
    {
      name: "Physical Education Cafeteria",
      coords: [32.016200, 35.875800],
      type: "cafeteria",
      icon: "🥤",
      description: "مطعم كلية التربية الرياضية"
    },
    {
      name: "Foreign Languages Cafeteria",
      coords: [32.015100, 35.873700],
      type: "cafeteria",
      icon: "🍜",
      description: "مطعم كلية اللغات الأجنبية"
    },
    {
      name: "Graduate Studies Cafeteria",
      coords: [32.015400, 35.874000],
      type: "cafeteria",
      icon: "🍰",
      description: "مطعم كلية الدراسات العليا"
    },
    {
      name: "Information Technology Cafeteria",
      coords: [32.0170, 35.8694],
      type: "cafeteria",
      icon: "💻",
      description: "مطعم كلية تكنولوجيا المعلومات"
    },
  
  // 🧭 Administrative Buildings
  {
      name: "مركز الاعتماد وضمان الجودة",
      coords: [32.53587789283093, 35.85422560279553],
      type: "admin",
      icon: "✅",
      description: "مركز الاعتماد وضمان الجودة"
    },
    {
      name: "مركز تكنولوجيا المعلومات",
      coords: [32.01418655747669, 35.87513960472205],
      type: "admin",
      icon: "💻",
      description: "مركز تكنولوجيا المعلومات"
    },
    {
      name: "مركز الاستشارات والتدريب",
      coords: [32.01645073512089, 35.8686111479272],
      type: "admin",
      icon: "🎓",
      description: "مركز الاستشارات والتدريب"
    },
    {
      name: "مركز الدراسات الاستراتيجية",
      coords: [32.01579728930828, 35.87322288158985],
      type: "admin",
      icon: "📊",
      description: "مركز الدراسات الاستراتيجية"
    },
    {
      name: "مركز الابتكار والريادة",
      coords: [32.01100075814241, 35.87337356969579],
      type: "admin",
      icon: "🚀",
      description: "مركز الابتكار والريادة"
    },
    {
      name: "المركز الثقافي الإسلامي",
      coords: [32.01794192943377, 35.86731131592276],
      type: "admin",
      icon: "🕌",
      description: "المركز الثقافي الإسلامي"
    },
    {
      name: "مركز اللغات",
      coords: [32.01759986968974, 35.868879905426574],
      type: "admin",
      icon: "🗣️",
      description: "مركز اللغات"
    },
    {
      name: "مركز تنمية وخدمة المجتمع",
      coords: [32.01425969188551, 35.86994989062896],
      type: "admin",
      icon: "🤝",
      description: "مركز تنمية وخدمة المجتمع"
    },
    {
      name: "مركز الترجمة",
      coords: [32.01720453011229, 35.86862947118994],
      type: "admin",
      icon: "🌐",
      description: "مركز الترجمة"
    },
    {
      name: "مركز التميّز في التعلّم والتعليم",
      coords: [32.020566265489286, 35.87089217781817],
      type: "admin",
      icon: "🏅",
      description: "مركز التميّز في التعلّم والتعليم"
    },
    {
      name: "مركز المتطلبات الجامعية العامة",
      coords: [32.01788578896773, 35.87177895902581],
      type: "admin",
      icon: "📚",
      description: "مركز المتطلبات الجامعية العامة"
    },
    {
      name: "دائرة اللوازم المركزية",
      coords: [32.00767535112363, 35.87789316271174],
      type: "admin",
      icon: "📦",
      description: "دائرة اللوازم المركزية"
    },
    {
      name: "دائرة الهندسة",
      coords: [32.01402358460938, 35.871933435151455],
      type: "admin",
      icon: "🛠️",
      description: "دائرة الهندسة"
    },
    {
      name: "دائرة خدمات الغذاء والتغذية",
      coords: [32.014911229018054, 35.87065859978065],
      type: "admin",
      icon: "🍽️",
      description: "دائرة خدمات الغذاء والتغذية"
    },
    {
      name: "دائرة التأمين الصحي",
      coords: [32.01370924153438, 35.87062892760129],
      type: "admin",
      icon: "🏥",
      description: "دائرة التأمين الصحي"
    },
    {
      name: "دائرة الصيانة",
      coords: [32.02507838374316, 35.71718461282805],
      type: "admin",
      icon: "🔧",
      description: "دائرة الصيانة"
    },
    {
      name: "دائرة العطاءات المركزية",
      coords: [32.016169102676535, 35.87230863842595],
      type: "admin",
      icon: "🔍",
      description: "دائرة العطاءات المركزية"
    },
    {
      name: "دائرة الأمن الجامعي",
      coords: [32.015011401770096, 35.87286485217471],
      type: "admin",
      icon: "🛡️",
      description: "دائرة الأمن الجامعي"
    },
    
    {
      name: "مطبعة الجامعة الأردنية",
      coords: [32.00678296348476, 35.87806045038001],
      type: "admin",
      icon: "🖨️",
      description: "مطبعة الجامعة الأردنية"
    },
    {
      name: "دائرة المحطات الزراعية",
      coords: [32.011710393548285, 35.87382061262491],
      type: "admin",
      icon: "🌾",
      description: "دائرة المحطات الزراعية"
    },

  // 🏥 Health Center
  {
      name: "Jordan University Hospital",
      coords: [32.00762305652195, 35.87476519455696],
      type: "health",
      icon: "🏥",
      description: "مستشفى الجامعة الأردنية"
    },
    {
      name: "Dental Teaching Clinics",
      coords: [32.007318981504774, 35.87403119787824],
      type: "health",
      icon: "🦷",
      description: "العيادات التعليمية لطب الأسنان"
    },
    {
      name: "Cell Therapy Center",
      coords: [32.00873826180824, 35.87229172651545],
      type: "health",
      icon: "🧬",
      description: "مركز العلاج بالخلايا"
    },
  // Housing
    {
      name: "سكن الأندلس للطالبات",
      coords: [32.01690402347635, 35.87412170003141],
      type: "housing",
      icon: "🏠",
      description: "سكن الأندلس للطالبات"
    },
    {
      name: "سكن الزهراء للطالبات",
      coords: [32.01604392491998, 35.87517275113919],
      type: "housing",
      icon: "🏠",
      description: "سكن الزهراء للطالبات"
    },
    {
      name: "سكن دانيا للطالبات",
      coords: [32.01497872832555, 35.86363874048336],
      type: "housing",
      icon: "🏠",
      description: "سكن دانيا للطالبات"
    },
    {
      name: "سكن بركات للطالبات",
      coords: [32.01463059296601, 35.868271234129146],
      type: "housing",
      icon: "🏠",
      description: "سكن بركات للطالبات"
    },
    {
      name: "سكن الفيحاء للطالبات",
      coords: [32.01513905640518, 35.866529367569775],
      type: "housing",
      icon: "🏠",
      description: "سكن الفيحاء للطالبات"
    },
    {
      name: "سكن بيت نيفين للطالبات",
      coords: [32.01581255342481, 35.86686291708107],
      type: "housing",
      icon: "🏠",
      description: "سكن بيت نيفين للطالبات"
    },
    // Parking
    {
      name: "موقف العلوم التربوية",
      coords: [32.02092901038408, 35.87213473002468],
      type: "parking",
      icon: "🅿️",
      description: "موقف العلوم التربوية"
    },
    {
      name: "موقف وحدة القبول والتسجيل (شارع الجامعة)",
      coords: [32.00938265059299, 35.87219921437988],
      type: "parking",
      icon: "🅿️",
      description: "موقف وحدة القبول والتسجيل (شارع الجامعة)"
    },
    {
      name: "بارك العلمية",
      coords: [32.014352039755764, 35.87623104177216],
      type: "parking",
      icon: "🅿️",
      description: "بارك العلمية"
    },
    {
      name: "بارك الفنون",
      coords: [32.00563449134202, 35.87688183607513],
      type: "parking",
      icon: "🅿️",
      description: "بارك الفنون"
    },
    {
      name: "بارك الجامعة الأردنية",
      coords: [32.01632346380355, 35.8684152706534],
      type: "parking",
      icon: "🅿️",
      description: "بارك الجامعة الأردنية"
    },
    // Warehouses
    {
      name: "مستودعات العلوم",
      coords: [32.00739595028027, 35.87928810232118],
      type: "warehouse",
      icon: "📦",
      description: "مستودعات العلوم"
    }
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
            <p class="popup-type">${location.type}</p>
            <div class="popup-actions">
                <button class="get-directions" data-id="${location.id}" data-lat="${location.coords[0]}" data-lng="${location.coords[1]}">
                    <i class="fas fa-route"></i> Get Directions
                </button>
                 <button class="save-location" data-id="${location.id}" data-lat="${location.coords[0]}" data-lng="${location.coords[1]}">
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
let searchResultsContainer = null;
let allLocations = locations; 
// Initialize search functionality
function initializeSearch() {
  console.log("Search")
  // Create search results container
  searchResultsContainer = document.createElement('div');
  searchResultsContainer.className = 'search-results';
  document.querySelector('.search-container').appendChild(searchResultsContainer);
  
  const searchInput = document.getElementById('location-search');
  const searchButton = document.getElementById('search-button');
  
  // Search on button click
  searchButton.addEventListener('click', performSearch);
  
  // Search on Enter key
  searchInput.addEventListener('keyup', function(e) {
      if (e.key === 'Enter') {
          performSearch();
      }
  });
  
  // Show results when typing
  searchInput.addEventListener('input', function() {
      if (this.value.length > 0) {
          performSearch();
      } else {
          clearSearchResults();
      }
  });
  
  // Hide results when clicking outside
  document.addEventListener('click', function(e) {
      if (!e.target.closest('.search-container')) {
          clearSearchResults();
      }
  });
}

function performSearch() {
  const searchTerm = document.getElementById('location-search').value.toLowerCase();
  
  if (searchTerm.length === 0) {
      clearSearchResults();
      return;
  }
  
  // Filter locations that match the search term
  const results = allLocations.filter(location => 
      location.name.toLowerCase().includes(searchTerm) ||
      (location.type && location.type.toLowerCase().includes(searchTerm))? location.type.slice(0, 100): null);
  displaySearchResults(results);
}

function displaySearchResults(results) {
  clearSearchResults();
  
  if (results.length === 0) {
      const noResults = document.createElement('div');
      noResults.className = 'search-result-item';
      noResults.textContent = 'No results found';
      searchResultsContainer.appendChild(noResults);
  } else {
      results.forEach(location => {
          const resultItem = document.createElement('div');
          resultItem.className = 'search-result-item';
          resultItem.innerHTML = `
              <strong>${location.name}</strong>
              <small>${location.type}</small>
          `;
          
          resultItem.addEventListener('click', function() {
              zoomToLocation(location);
              clearSearchResults();
          });
          
          searchResultsContainer.appendChild(resultItem);
      });
  }
  
  searchResultsContainer.style.display = 'block';
}

function clearSearchResults() {
  if (searchResultsContainer) {
      searchResultsContainer.innerHTML = '';
      searchResultsContainer.style.display = 'none';
  }
}

function zoomToLocation(location) {
  map.setView(location.coords, 18); // Zoom to level 18
  document.getElementById('location-search').value = location.name;
  
  // Open the marker's popup if it exists
  allMarkers.forEach(markerItem => {
      if (markerItem.marker.getLatLng().equals(location.coords)) {
          markerItem.marker.openPopup();
      }
  });
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
        // Remove routing control (closes the panel)
      //   if (routingControl) {
      //     map.removeControl(routingControl);
      //     routingControl = null;
      // }
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
  
  // If no filters are active, show nothing
  if (activeTypes.length === 0) {
      return;
  }
  
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

filterMarkers();
setupDirections();

initializeSearch();

document.addEventListener("click", function (e) {
  var btn = e.target.closest(".save-location");

  if (!btn) return;
  var lat = btn.dataset.lat;
  var lng = btn.dataset.lng;
  var id = btn.dataset.id;
  // grab the popup’s title and type if you need them:
  var popup = btn.closest(".leaflet-popup");
  var name = popup.querySelector("h4").textContent;
  var type = popup.querySelector(".popup-type").textContent.toLowerCase();

  fetch("/Student_Dashboard/Save-Location.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: new URLSearchParams({
      lat: lat,
      lng: lng,
      name: name,
      type: type,
    }),
  })
    .then((r) => r.json())
    .then((json) => {
      if (!json.error) {
        alert("Location saved!");
      } else {
        alert("Error: " + json.msg);
      }
    })
    .catch((err) => {
      console.error(err);
      alert("Network error");
    });
});
