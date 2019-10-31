

// QUESTION VARIABLE COUNT
let question_count = 0;

// FUNCTION :: ADDS A NEW QUESTION
const addQuestion = ()=>{

    //SELECTING DIVISION IN WHICH QUESTION IS TO BE ADDED
    const DOMElement = document.getElementById('questions_list');
    
    // INCREMENT QUESTIONS
    question_count++;

    // HTML CONTENT
    let HTML = `
            <div class="form-row" id="question_${question_count}" style="margin: 15px; border:1px solid #e2e2e2; padding: 15px;">
                <div class="col-md-12 row"  style="padding-top: 0.5em;">
                    <div class="col-md-11">

                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger float-right button_collapse" onclick="deleteQuestion(event)">
                            Delete Question
                        </button>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="this_is_question_${question_count}">Question:</label>
                    <input type="text" name="this_is_question_${question_count}" id="this_is_question_${question_count}" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="question_${question_count}_num_of_options">Number of Inputs:</label>
                    <input type="number" name="question_${question_count}_num_of_options" id="question_${question_count}_num_of_options" class="form-control" min="2" max="6" required>
                </div>
                <div class="row col-md-12" id="question_${question_count}_option_list"></div>
                <div class="form-group row col-md-12">
                    <label for="question_${question_count}_correct_answer" class="col-sm-2 col-form-label">Correct Option number</label>
                    <div class="col-sm-10">
                    <input type="number" min="1" max="4" class="form-control" name="question_${question_count}_correct_answer" id="question_${question_count}_correct_answer" placeholder="Enter Option here">
                    </div>
                </div>
            </div>
    `;

    // ADDING QUESTION TO DOM
    DOMElement.insertAdjacentHTML("beforeend", HTML);

    // UPDATING NUMBER OF QUESTIONS
    const questionCounter = document.getElementById('number_of_questions');
    let num_of_questions = parseInt(questionCounter.value);
    num_of_questions++;
    questionCounter.value = num_of_questions;

    // ADD EVENT LISTENER THAT WILL ENABLE THE NUMBER OF OPTIONS
    addThisEventToInput();

};

const addThisEventToInput = ()=>{

    // SELECTING DOM ELEMENTS
    const DOMElement = document.getElementById(`question_${question_count}_num_of_options`);
    const DIV = document.getElementById(`question_${question_count}_option_list`);

    // ADDING EVENT LISTENERS
    DOMElement.addEventListener('input', function() { 
        DIV.innerHTML = ""; 
        let num_of_times = DOMElement.value;
        if(num_of_times == 1){
            num_of_times = 2;
        }
        if(num_of_times > 4){
            num_of_times = 4;
        }
        DOMElement.value = num_of_times;
        for(let i=0; i<num_of_times; i++){
            
            let HTMLText = `
            <div class="form-group col-sm-12">
                <label for="question_${question_count}_option_${i}" class=" col-form-label">Enter option ${i+1}:</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" name="question_${question_count}_option_${i}" id="question_${question_count}_option_${i}" placeholder="Enter option content here.."  required>
                </div>
            </div>
            `;
            DIV.insertAdjacentHTML("beforeend", HTMLText);
        }
    });

};

const deleteQuestion = (e)=>{

    // REMOVING THE REQUIRED NODE
    const parent_id = e.target.parentElement.parentElement.parentElement.id;
    const DOMElement = document.getElementById(parent_id);
    DOMElement.remove();

    // UPDATING NUMBER OF QUESTIONS
    const questionCounter = document.getElementById('number_of_questions');
    console.log(questionCounter);
    let num_of_questions = parseInt(questionCounter.value);
    num_of_questions--;
    questionCounter.value = num_of_questions;

};

const callLocalStorage = (event)=>{
    let test_id = event.target.id;
    localStorage.setItem("test_id", test_id);
    window.location.assign("http://localhost:8080/online-examination-system/views/see_response.php");
}

