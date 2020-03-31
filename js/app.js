collapseProjects();

function collapseProjects()
{
  document.querySelectorAll('.project').forEach(function(item) {
    if ( item.clientHeight > 600 ) {
      collapseItem(item);
    }
  });
}

function collapseItem(item)
{
  var buttonBlock = document.createElement('div');
  var descriptionBlock = item.querySelector('.project__description-block');

  buttonBlock.className = "project__button-block";
  buttonBlock.innerHTML = "РАЗВЕРНУТЬ";
  buttonBlock.onclick = function(){
    expandItem(this);
  };
  descriptionBlock.append(buttonBlock);
  item.classList.add("project_collapse");
}

function expandItem(item)
{
  var parent = item.parentNode;

  parent.removeChild(item);
  parent.parentNode.classList.remove("project_collapse");
}