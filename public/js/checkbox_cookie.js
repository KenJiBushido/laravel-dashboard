var aa_checkbox;

function init_checkbox(){
  //setup blank cb cookie
  if(!Cookie.read('cb')){
    Cookie.write('cb', JSON.encode({}));
  }
  
  //setup "associative array" to match what is currently in the cookie
  aa_checkbox = JSON.decode(Cookie.read('cb'));
  
  
  //set up each checkbox with class="remember_cb"
  $$('input.remember_cb').each(function(el){
    
    //mark checked if it is in the cookie
    if(aa_checkbox[el.name]){
      el.checked = 'checked'
    }
    
    //setup onclick event to put checkbox status in the 
    el.addEvent('click', function(){
      if(el.checked){
        aa_checkbox[el.name] = el.value;
      }else{
        delete(aa_checkbox[el.name]);
      }   
    })
  })

  //save aa_checkbox back into cookie upon leaving a page
  window.onbeforeunload = function(){Cookie.write('cb', JSON.encode(aa_checkbox));};
  
  setup_form();
  
  return true;
}

function setup_form(){
  //set up form so that it adds the inputs upon submit.
  $$('form.remember_cb_form').each(function(form){
    form.addEvent('submit', function(ev){
      //clean up previously inserted inputs
      var aa_hidden_insert = $$('input.hidden_insert');
      $each(aa_hidden_insert, function(el){ 
        el.parentNode.removeChild(el);
      })
    
      var el_form = this;
      
      //insert hidden elements representing the values stored in aa_checkbox
      $each(aa_checkbox, function(i_value, s_name){
        if(i_value){ 
          var el_input = document.createElement('input');
          el_input.type = 'hidden';
          el_input.value = i_value;
          el_input.name = s_name;
          el_input.setAttribute('class', 'hidden_insert');
          el_form.appendChild(el_input);
        }
      });
    });
  });
}

window.addEvent('domready', init_checkbox);
