document.addEventListener('DOMContentLoaded', () => {
    const icons = document.querySelectorAll('.icon');

    icons.forEach((icon) => {
        icon.addEventListener('mouseenter', highlightIcon);
        icon.addEventListener('focus', highlightIcon);
        icon.addEventListener('click', selectIcon);
    });

    function highlightIcon(event) {
        // Add a class to the icon or directly change styles
        event.target.style.borderColor = 'green'; // Example of direct style change
    }

    function selectIcon(event) {
        // Here you can define what happens when an icon is selected
        console.log('Icon selected: ' + event.target.id); // Placeholder action
    }
})

document.addEventListener('DOMContentLoaded', () => {
    const icons = document.querySelectorAll('.icon');
    const overlay = document.createElement('div');
    overlay.className = 'overlay';
    document.body.appendChild(overlay);

    const popup = document.createElement('div');
    popup.className = 'popup';
    document.body.appendChild(popup);

    const closeButton = document.createElement('span');
    closeButton.innerHTML = '&times;';
    closeButton.className = 'popup-close';
    popup.appendChild(closeButton);

    icons.forEach((icon) => {
        icon.addEventListener('click', function() {
            popup.innerHTML = `<strong>${icon.textContent.trim()} Course Completed</strong>`;
            popup.appendChild(closeButton); // Re-add close button after setting innerHTML
            overlay.style.display = 'block';
            popup.style.display = 'block';
        });
    });

    closeButton.addEventListener('click', function() {
        overlay.style.display = 'none';
        popup.style.display = 'none';
    });

    overlay.addEventListener('click', function() {
        overlay.style.display = 'none';
        popup.style.display = 'none';
    });
});

// script.js
function toggleVisibility(elementId) {
    var element = document.getElementById(elementId);
    if (element) {  // Check if the element exists
      if (element.style.display === "none" || !element.style.display) {
        element.style.display = "block";
      } else {
        element.style.display = "none";
      }
    } else {
      console.error('Element not found:', elementId);
    }
  }
  
  function showMemoryCardInterface(clickedId) {
    const clickedElement = document.getElementById(clickedId);
    const isFullStudents = clickedId === 'rectangle3';
    const otherElementId = isFullStudents ? 'rectangle4' : 'rectangle3';
    const otherElement = document.getElementById(otherElementId);
    const memoryCardInterface = document.getElementById('memory-card-interface');

    // Handle the other element's deactivation if it is active
    deactivateOtherElement(otherElement, memoryCardInterface);

    // Toggle the current element
    if (clickedElement.classList.contains('active')) {
        deactivateElement(clickedElement, memoryCardInterface);
    } else {
        activateElement(clickedElement, memoryCardInterface, isFullStudents ? 'green' : 'yellow');
    }
}

function deactivateOtherElement(element, interfaceElement) {
    if (element.classList.contains('active')) {
        element.classList.remove('active');
        element.style.backgroundColor = 'white';
        hideInterface(interfaceElement);
    }
}

function deactivateElement(element, interfaceElement) {
    element.classList.remove('active');
    element.style.backgroundColor = 'white';
    hideInterface(interfaceElement);
}

function activateElement(element, interfaceElement, color) {
    element.classList.add('active');
    element.style.backgroundColor = color;
    showInterface(interfaceElement);
}

function showInterface(interfaceElement) {
    interfaceElement.style.display = 'flex';
    interfaceElement.style.opacity = 0;
    interfaceElement.style.transform = 'scale(0.9)';
    setTimeout(() => {
        interfaceElement.style.opacity = 1;
        interfaceElement.style.transform = 'scale(1)';
    }, 10);
}

function hideInterface(interfaceElement) {
    interfaceElement.style.opacity = 0;
    interfaceElement.style.transform = 'scale(0.9)';
    setTimeout(() => {
        interfaceElement.style.display = 'none';
    }, 300);
}

  
