
    function start(objectList)
    {
        initializeState('TV', ['AmR.png', '.png'], objectList[0]);
        initializeState('PC', ['PCr.png', 'PCg.png'], objectList[1]);
    }

    function initializeState(id, elements, JSONobjectsList) {
        let state = JSONobjectsList.currentState;

        console.log(JSONobjectsList);

        if (state == 0)
        {
            document.getElementById(id).src = '../images/' + elements[0];
        }
        else if (state == 1)
        {
            document.getElementById(id).src = '../images/' + elements[1];
        }

    }

    function changeState(id, elements, JSONobjectsList)
    {
        let state = JSONobjectsList.currentState;

        if (state == 1)
        {
            document.getElementById(id).src = '../images/' + elements[0];
            state=0;

        }
        else if (state == 0)
        {
            document.getElementById(id).src = '../images/' + elements[1];
            state=1;
        }

        window.location.replace('/home/' + JSONobjectsList.id)
    }


