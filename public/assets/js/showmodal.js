var checkeventcount = 1,prevTarget;
    $('.modal').on('show.bs.modal', function (e) {
        if(typeof prevTarget == 'undefined' || (checkeventcount==1 && e.target!=prevTarget))
        {  
          prevTarget = e.target;
          checkeventcount++;
          e.preventDefault();
          $(e.target).appendTo('body').modal('show');
        }
        else if(e.target==prevTarget && checkeventcount==2)
        {
          checkeventcount--;
        }
     });