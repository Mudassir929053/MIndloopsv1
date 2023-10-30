const draggableElems = document.querySelectorAll(".draggable");
const droppableElems = document.querySelectorAll(".droppable");
let numDropped = 0;

function shuffleArray(array) {
  for (let i = array.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [array[i], array[j]] = [array[j], array[i]];
  }
  return array;
}

const shuffledDraggable = shuffleArray(Array.from(draggableElems));
const shuffledDroppable = shuffleArray(Array.from(droppableElems));

shuffledDraggable.forEach((elem) => {
  elem.addEventListener("dragstart", dragStart);
  document.querySelector(".draggable-elements").appendChild(elem);
});

shuffledDroppable.forEach((elem) => {
  elem.addEventListener("dragenter", dragEnter);
  elem.addEventListener("dragover", dragOver);
  elem.addEventListener("dragleave", dragLeave);
  elem.addEventListener("drop", drop);
  document.querySelector(".droppable-elements").appendChild(elem);
});

function dragStart(event) {
  event.dataTransfer.setData("text", event.target.id);
}

function dragEnter(event) {
  event.target.classList.add("droppable-hover");
}

function dragOver(event) {
  event.preventDefault();
}

function dragLeave(event) {
  event.target.classList.remove("droppable-hover");
}

function drop(event) {
  event.preventDefault();

  // Set unique data for both elements
  const draggableElemData = event.dataTransfer.getData("text");
  const droppableElemData = event.target.dataset.draggableId;

  // Check if element is positioned correctly
  if (draggableElemData === droppableElemData) {
    // Get elements
    const droppableElem = event.target;
    const draggableElem = document.getElementById(draggableElemData);

    // Change the state of droppable element
    droppableElem.style.backgroundImage = draggableElem.style.backgroundImage;
    droppableElem.style.backgroundSize = "100% 100%";
    droppableElem.style.backgroundRepeat = "no-repeat";
    droppableElem.classList.add("dropped");

    // Change the state of draggable element
    draggableElem.classList.add("dragged");
    draggableElem.setAttribute("draggable", "false");

    // Increment counter variable
    numDropped++;

    // Check if all draggable elements have been dropped
    if (numDropped === draggableElems.length) {
      // Show modal
      showPopup();
    }
  } else {
    event.target.classList.remove("droppable-hover");
  }
}

function showPopup() {
  const modal = document.getElementById("myModal");
  const playAgainBtn = document.getElementById("play-again-btn");
  const quitBtn = document.getElementById("quit-btn");

  modal.style.display = "block";

  playAgainBtn.addEventListener("click", () => {
    window.location.reload();
  });

  quitBtn.addEventListener("click", () => {
    window.location.href = "index.php";
  });

  const closeBtn = document.querySelector(".close");
  closeBtn.addEventListener("click", () => {
    modal.style.display = "none";
  });
}
