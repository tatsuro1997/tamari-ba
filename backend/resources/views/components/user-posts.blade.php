<div class="flex flex-wrap" id="tabs-id">
  <div class="w-full">
    <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
      <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
        <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-white bg-indigo-900" onclick="changeAtiveTab(event,'tab-comment')">
           Comment
        </a>
      </li>
      <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
        <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-indigo-900 bg-white" onclick="changeAtiveTab(event,'tab-bike')">
           Bike
        </a>
      </li>
      <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
        <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-indigo-900 bg-white" onclick="changeAtiveTab(event,'tab-road')">
           Road
        </a>
      </li>
      <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
        <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-indigo-900 bg-white" onclick="changeAtiveTab(event,'tab-board')">
           Board
        </a>
      </li>
    </ul>
    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
      <div class="px-4 py-5 flex-auto">
        <div class="tab-content tab-space">
          <div class="block" id="tab-comment">
            <x-comment-index :user="$user" :roads="$roads" />
          </div>
          <div class="block" id="tab-bike">
            <p>
                TODO:バイク一覧が入る
            </p>
          </div>
          <div class="hidden" id="tab-road">
            <x-road-index :roads="$roads" type="profile" />
          </div>
          <div class="hidden" id="tab-board">
            <p>
                TODO:掲示板一覧が入る
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function changeAtiveTab(event,tabID){
    let element = event.target;
    while(element.nodeName !== "A"){
      element = element.parentNode;
    }
    ulElement = element.parentNode.parentNode;
    aElements = ulElement.querySelectorAll("li > a");
    tabContents = document.getElementById("tabs-id").querySelectorAll(".tab-content > div");
    for(let i = 0 ; i < aElements.length; i++){
      aElements[i].classList.remove("text-white");
      aElements[i].classList.remove("bg-indigo-900");
      aElements[i].classList.add("text-indigo-900");
      aElements[i].classList.add("bg-white");
      tabContents[i].classList.add("hidden");
      tabContents[i].classList.remove("block");
    }
    element.classList.remove("text-indigo-900");
    element.classList.remove("bg-white");
    element.classList.add("text-white");
    element.classList.add("bg-indigo-900");
    document.getElementById(tabID).classList.remove("hidden");
    document.getElementById(tabID).classList.add("block");
  }
</script>
