// UI helper functions
function showMessage(target, text, type='error'){
  let el = document.querySelector(target);
  if(!el) return;
  el.textContent = text;
  el.className = 'message ' + (type==='error' ? 'error' : 'success');
}

function clearMessage(target){
  let el = document.querySelector(target);
  if(!el) return;
  el.textContent = '';
  el.className = '';
}

window.showMessage = showMessage;
window.clearMessage = clearMessage;
