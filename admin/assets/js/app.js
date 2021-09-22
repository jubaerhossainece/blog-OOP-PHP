
//mark as read
function mark_read(){
    let values = [];

    $('#mail-checkbox input[type="checkbox"]').each(function(){
        let $this = $(this);
        if ($this.is(':checked')) {
            values.push($this.val());
        }
    });
    
    $('#mail-array').val(values);
    if(values == ''){
        return false;
    }else{
        $('#action-form #action-type').val('mark_as_read');
        $('#action-form').submit();
    }
}

//mark as unread
function mark_unread(){
    let values = [];

    $('#mail-checkbox input[type="checkbox"]').each(function(){
        let $this = $(this);
        if ($this.is(':checked')) {
            values.push($this.val());
        }
    });
    
    $('#mail-array').val(values);
    if(values == ''){
        return false;
    }else{
        $('#action-form #action-type').val('mark_as_unread');
        $('#action-form').submit();
    }
}

//mark as starred
function mark_star(){
    let values = [];

    $('#mail-checkbox input[type="checkbox"]').each(function(){
        let $this = $(this);
        if ($this.is(':checked')) {
            values.push($this.val());
        }
    });
    
    $('#mail-array').val(values);
    if(values == ''){
        return false;
    }else{
        $('#action-form #action-type').val('mark_as_starred');
        $('#action-form').submit();
    }
}

//mark as important
function mark_important(){
    let values = [];

    $('#mail-checkbox input[type="checkbox"]').each(function(){
        let $this = $(this);
        if ($this.is(':checked')) {
            values.push($this.val());
        }
    });
    
    $('#mail-array').val(values);
    if(values == ''){
        return false;
    }else{
        $('#action-form #action-type').val('mark_as_important');
        $('#action-form').submit();
    }
}

// send to trash box
function make_trash(){
    let values = [];

    $('#mail-checkbox input[type="checkbox"]').each(function(){
        let $this = $(this);
        if ($this.is(':checked')) {
            values.push($this.val());
        }
    });
    
    $('#mail-array').val(values);
    if(values == ''){
        return false;
    }else{
        $('#action-form #action-type').val('mark_as_trashed');
        $('#action-form').submit();
    }
}