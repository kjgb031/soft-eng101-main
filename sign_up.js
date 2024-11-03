const data = {

  // Main Campus
  "main": {
    "College of Allied Health Sciences": {
      "Bachelor of Science in Nursing": [""],
      "Bachelor of Science in Midwifery": [""]
    },

    "College of Computer Studies": {
      "Bachelor of Computer Science": ["Network and Data Communication", "Software Development"],
      "Bachelor of Science in Entertainment and Multimedia Computing": ["Digital Animation Technology", "Game Development"],
      "Bachelor of Science in Information Technology": ["Network and Web Application"],
      "Bachelor of Science in Data Science": [""]
    },

    "College of Arts and Sciences": {
      "Bachelor of Arts in Communication": ["Creative and Performing Arts", "New Media Track"],
    },

    "College of Business and Accountancy": {
      "Bachelor of Science in Hospitality Management": [""],
      "Bachelor of Science in Tourism Management": [""]
    },
    
    "College of Engineering and Architecture": {
      "Bachelor of Science in Architecture": [""],
      "Bachelor of Science in Civil Engineering": ["Construction Engineering and Management", "Structural Engineering"],
      "Bachelor of Science in Electrical Engineering": [""],
      "Bachelor of Science in Electronics Engineering": [""],
      "Bachelor of Science in Industrial Engineering": [""],
      "Bachelor of Science in Mechanical Engineering": [""]
    },

    "College of Technology": {
      "Bachelor of Technical Vocational Teacher Education": ["Animation", "Automotive Technology", "Civil and Construction Technology", "Drafting Technology", "Electrical Technology", "Food and Service Management", "Garments, Fashion and Design", "Hotel and Restaurant Services", "Mechanical Technology", "Welding and Fabrication Technology"],
      "Bachelor of Science in Industrial Technology": ["Automative Technology", "Drafting Technology", "Electrical Technology", "Electronics Technology", "Food and Service Management", "Garments, Fashion and Design", "Heating, Ventilating and Air Conditioning Technology", "Mechanical Technology", "Welding and Fabrication Technology"]
    },

  // Balanga Campus
  },
  "balanga": {
    "College of Business and Accountancy": {
      "Bachelor of Science in Accountancy": [""],
      "Bachelor of Science in Business Administration": ["Human Resource Management", "Marketing Management", "Operations Management"]
    },

    "College of Education": {
      "Bachelor of Secondary Education": ["English", "Filipino", "Social Studies"]
    },

    "College of Social and Behavioral Sciences": {
      "Bachelor of Arts in Psychology": [""],
      "Bachelor of Science in Psychology": [""]
    },

    "Institute of Public Administration and Governance": {
      "Bachelor of Public Administration": [""]
    }
  },

  // Abucay Campus
"abucay": {
  "College of Agriculture and Fisheries": {
    "Bachelor of Science in Agriculture": ["Animal Science", "Crop Science", ""],
    "Bachelor of Science in Business Administration": ["Human Resource Management", "Marketing Management", "Operations Management"]
  },

  "College of Education": {
    "Bachelor of Technical-Vocational Teacher Education": ["Agricultural Crops Production", "Animal Production"]
  },

  "Institute Of Agricultural And Biosystems Engineering": {
    "Bachelor of Science in Agricultural and Biosystems Engineering": [""]
    }
  },

   // Orani Campus
"orani": {
  "College of Agriculture and Fisheries": {
    "Bachelor of Science in Fisheries": [""],
    },

  "College of Education": {
    "Bachelor of Physical Education": [""],
    "Bachelor of Science in Exercise and Sports Sciences": ["Fitness and Sports Coaching", "Fitness and Sports Management"],
    "Bachelor of Technology and Livelihood Education": ["Industrial Arts"]
  
  }
},

  // Dinalupihan Campus
"dinalupihan": {
  "College of Education": {
    "Bachelor of Early Childhood Education": [""],
    "Bachelor of Elementary Education": [""],
    "Bachelor of Secondary Education": ["Mathematics", "Science"]
    }
  },

   // Bagac Campus
"bagac": {
  "College of Education": {
    "Bachelor of Elementary Education": [""]
    },

  "College of Technology": {
    "Bachelor of Science in Industrial Technology": ["Electrical Technology", "Welding and Fabrication Technology"]
    } 
  }
};

const campusSelect = document.getElementById("campus");
const collegeSelect = document.getElementById("college");
const programSelect = document.getElementById("program");
const majorSelect = document.getElementById("major");

function populateSelect(selectElement, options) {
    selectElement.innerHTML = '<option value="">Select ' + selectElement.id.charAt(0).toUpperCase() + selectElement.id.slice(1) + '</option>';
    for (const option in options) {
        const newOption = document.createElement("option");
        newOption.value = option;
        newOption.textContent = option;
        selectElement.appendChild(newOption);
    }
}

function updateColleges() {
    const selectedCampus = campusSelect.value;
    if (selectedCampus && data[selectedCampus]) {
        populateSelect(collegeSelect, data[selectedCampus]);
        programSelect.innerHTML = '<option value="">Select Program</option>';
        majorSelect.innerHTML = '<option value="">Select Major</option>';
    } else {
        collegeSelect.innerHTML = '<option value="">Select College</option>';
        programSelect.innerHTML = '<option value="">Select Program</option>';
        majorSelect.innerHTML = '<option value="">Select Major</option>';
    }
}

function updatePrograms() {
    const selectedCampus = campusSelect.value;
    const selectedCollege = collegeSelect.value;
    if (selectedCampus && selectedCollege && data[selectedCampus][selectedCollege]) {
        populateSelect(programSelect, data[selectedCampus][selectedCollege]);
        majorSelect.innerHTML = '<option value="">Select Major</option>';
    } else {
        programSelect.innerHTML = '<option value="">Select Program</option>';
        majorSelect.innerHTML = '<option value="">Select Major</option>';
    }
}

function updateMajors() {
    const selectedCampus = campusSelect.value;
    const selectedCollege = collegeSelect.value;
    const selectedProgram = programSelect.value;
    if (selectedCampus && selectedCollege && selectedProgram && data[selectedCampus][selectedCollege][selectedProgram]) {
        populateSelect(majorSelect, data[selectedCampus][selectedCollege][selectedProgram].reduce((acc, major) => {
            acc[major] = major;
            return acc;
        }, {}));
    } else {
        majorSelect.innerHTML = '<option value="">Select Major</option>';
    }
}

function validateForm() {
  const password = document.getElementById("password").value;
  const confirmPassword = document.getElementById("confirmPassword").value;
  const passwordError = document.getElementById("passwordError");

  if (password !== confirmPassword) {
      passwordError.style.display = "block";
      document.getElementById("password").value = "";
      document.getElementById("confirmPassword").value = "";
      return false;
  } else {
      passwordError.style.display = "none";
      return true;
  }
}

populateSelect(campusSelect, data); 