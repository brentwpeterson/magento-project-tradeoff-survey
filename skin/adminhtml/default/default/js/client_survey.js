$$('#survey-table select').each(function(se) {
    se.observe('focus', function(){
        $$('#survey-table select').each(function(elm) { elm.removeClassName('focus'); });
        se.addClassName('focus');
        updatePoints();
    });
});

Event.observe($('client-survey'), 'change', function(){
    validateSurvey();
});

function loadSurvey() {
    if (survey) {
        $('client-survey').elements['cost'].selectedIndex  = survey.cost;
        $('client-survey').elements['cost_comment'].value = survey.cost_comment;
        $('client-survey').elements['duration'].selectedIndex  = survey.duration;
        $('client-survey').elements['duration_comment'].value = survey.duration_comment;
        $('client-survey').elements['user_adoption'].selectedIndex  = survey.user_adoption;
        $('client-survey').elements['user_adoption_comment'].value = survey.user_adoption_comment;
        $('client-survey').elements['project_goals'].selectedIndex  = survey.project_goals;
        $('client-survey').elements['project_goals_comment'].value = survey.project_goals_comment;
        $('client-survey').elements['certainty'].selectedIndex  = survey.certainty;
        $('client-survey').elements['certainty_comment'].value = survey.certainty_comment;
    }

    updatePoints();
}

function resetForm() {
    $('client-survey').reset()
    updatePoints();
}

function submitForm() {
    if (validateSurvey()) {
        client_survey.submit();
    }
}

function validateSurvey() {
    var counter = 0;
    var total = 0;
    $('survey-table').getElementsBySelector('select').each(function(elm){
        if ( 2 == parseInt(elm.value)) counter++;
        total += parseInt(elm.value);
    });

    if (counter == 5 && !$('validation-message')) {
        div = document.createElement('div');
        div.addClassName('validation-advice');
        div.setAttribute('id', 'validation-message');
        div.innerHTML = 'You can\'t allocated 2 across all of them.';
        $('survey-table').appendChild(div);
    }
    else if (total != 10 && !$('validation-message')) {
        div = document.createElement('div');
        div.addClassName('validation-advice');
        div.setAttribute('id', 'validation-message');
        div.innerHTML = 'Please spend 10 points.';
        $('survey-table').appendChild(div);
    }
    else {
        if ($('validation-message')) $('validation-message').remove();
    }

    if (counter == 5 || total != 10) {
        return false;
    }
    else {
        return true;
    }
}

function updatePoints() {
    var total = 0;
    $('survey-table').getElementsBySelector('select').each(function(elm){
        if (!elm.hasClassName('focus')) total += parseInt(elm.value);
    });

    /*update options*/
    $('survey-table').getElementsBySelector('select').each(function(elm){
        elm.getElementsBySelector('option').each(function(ee) {
            if (10 - total >= parseInt(ee.value) || parseInt(ee.value) <= parseInt(elm.value) ) {
                if (ee.hasAttribute('disabled')) ee.removeAttribute('disabled');
            }
            else {
                ee.setAttribute('disabled', 'disabled');
            }
        });
    });
}

loadSurvey();
