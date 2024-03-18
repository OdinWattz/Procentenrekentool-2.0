const oud = document.getElementById("oud")

const soort = document.getElementById("soort")
const percentage = document.getElementById("percentage")

const nieuw = document.getElementById("nieuw")

const factor = document.getElementById("vFactor")
const deelfactor = document.getElementById("dFactor")

let ber_factor

function checkInput()
{
    if(oud.value != '')
        oud.classList.remove("is-invalid")
        oud.classList.add("is-valid")
    if(nieuw.value != '')
        nieuw.classList.remove("is-invalid")
        nieuw.classList.add("is-valid")
    if(soort.value != '')
        soort.classList.remove("is-invalid")
        soort.classList.add("is-valid")
    if(percentage.value != '')
        percentage.classList.remove("is-invalid")
        percentage.classList.add("is-valid")
    if(
    
        (oud.value != '' && nieuw.value != '') ||
        (oud.value != '' && soort.value != '' && percentage.value != '') ||
        (nieuw.value != '' && soort.value != '' && percentage.value != '')
    )
        document.getElementById("losop_btn").disabled = false

        if(soort.value != '' && percentage.value != '')
        {
            if(soort.value == 1)
                ber_factor = percentage.value / 100
            else if (soort.value == 2)
                ber_factor = 1 + percentage.value / 100
            else 
                ber_factor = 1 - percentage.value / 100
            factor.value = ber_factor
            deelfactor.value = ber_factor
        }
}

function solveProblem()
{
   if(oud.value != '' && soort.value != '' && percentage.value != '')
        nieuw.value = oud.value * ber_factor
    else if(nieuw.value != '' && soort.value != '' && percentage.value != '')
        oud.value = nieuw.value / ber_factor
    else 
        ber_factor = nieuw.value / oud.value
        factor.value = ber_factor
        deelfactor.value = ber_factor
    

}

