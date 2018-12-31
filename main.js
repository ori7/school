const loadFile = function (event) {
  const getImg = document.getElementById('getImg');
  getImg.src = URL.createObjectURL(event.target.files[0]);
};

function validate(e, maxLength, comment) {
  const length = e.target.value.length;
  const element = document.getElementsByClassName(comment)[0];
  if (length > maxLength)
    element.classList.add('visible');
  else if (element.classList.contains('visible'))
    element.classList.remove('visible');
}

function validateRole(e, comment) {
  const value = e.target.value;
  const element = document.getElementsByClassName(comment)[0];
  if (value != 1 && value != 2 && value != 3)
    element.classList.add('visible');
  else if (element.classList.contains('visible'))
    element.classList.remove('visible');
}

function validatePassword(e, maxLength, minLength, comment) {
const length = e.target.value.length;
const element = document.getElementsByClassName(comment)[0];
  if (length > maxLength || length < minLength)
    element.classList.add('visible');
  else if (element.classList.contains('visible'))
    element.classList.remove('visible');
}