
function preventDefaults (e) {
  e.preventDefault();
  e.stopPropagation();
}


let filesDone = 0;
let filesToDo = 0;

function handleDrop(e) {
  let dt = e.dataTransfer;
  let files = dt.files;

  handleFiles(files);
}

function handleFiles(files) {
  files = [...files];
  files.forEach(uploadFile);
  files.forEach(previewFile);
}

function uploadFile(file, i) {
  $.ajax({
    type: "POST",
    url: 'Model/imageloggin.php',
    data:{prodname:file.name},
    success:function(html) {
      // console.log("User "+evt.target.value+" sent");
      if(html!="Le produit est maintenant en vente !"){
        console.log(html);
      } else {
        console.log(html);
        var url = 'Model/imageupload.php';
        var xhr = new XMLHttpRequest();
        var formData = new FormData();
        xhr.open('POST', url, true);

        xhr.addEventListener('readystatechange', function(e) {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log("File uploaded");
              }
              else if (xhr.readyState == 4 && xhr.status != 200) {
                  console.log("File not uploaded : "+formData+" "+xhr+" "+url);
                }
              })
              // window.open(url, '_blank');
              formData.append('file', file)
              xhr.send(formData)
      }
    }
  });
}


function previewFile(file) {
  let reader = new FileReader();
  reader.readAsDataURL(file);
  reader.onloadend = function() {
    let img = document.createElement('img');
    img.src = reader.result;
    document.getElementById('gallery').appendChild(img);
  }
}

function viewFile(file,shop) {
  let reader = new FileReader();
  reader.readAsDataURL(file);
  shop = "shop"+shop;
  reader.onloadend = function() {
    let img = document.createElement('img');
    img.src = reader.result;
    document.getElementsByClass(shop).appendChild(img);
  }
}


function allowDrop(ev) {
  console.log('File(s) in drop zone');
  ev.preventDefault();
}
function drop(ev) {
  console.log('File(s) dropped');

  ev.preventDefault();

  if (ev.dataTransfer.items) {
    for (var i = 0; i < ev.dataTransfer.items.length; i++) {
      if (ev.dataTransfer.items[i].kind === 'file') {
        var file = ev.dataTransfer.items[i].getAsFile();
        console.log('... file[' + i + '].name = ' + file.name + file);
        uploadFile(file);
        previewFile(file);
      }
    }
  } else {
    for (var i = 0; i < ev.dataTransfer.files.length; i++) {
      console.log('... file[' + i + '].name = ' + ev.dataTransfer.files[i].name);
    }
  }
  ev.preventDefault();
}

function search (evt){
  console.log(evt.target.value);
  if (evt.target.value==""){
    for (n in document.getElementsByClassName('shop')){
      document.getElementsByClassName('shop')[n].style.display="unset";
    }
  }
  test=evt.target.value.split("");
  // console.log(test);
  for (n in document.getElementsByClassName('shop')){
    work=false;
    tst="";
    doc=document.getElementsByClassName('shop')[n].children[0].alt.split("_",2)[1].split(".")[0];
    test1=doc.toLowerCase().split("");
    test2=doc.toUpperCase().split("");
    letter=0;
    for (i in test1){
      // console.log(test1,test[letter]);
      if (test1[i]==test[letter] || test2[i]==test[letter].toUpperCase()){
        tst+=test1[i];
        letter++;
        if (letter==test.length){
          work=true;
          letter=0;
        }
      } else {
        tst="";
        letter=0;
      }
    }
    if (work==true) {
      document.getElementsByClassName('shop')[n].style.display="unset";
    } else {
      document.getElementsByClassName('shop')[n].style.display="none";
    }
    // console.log(letter);
    // console.log(tst);
    console.log(work);
  }
}

function verif (evt){
  $.ajax({
    type: "POST",
    url: 'Model/verif.php',
    data:{verifyuser:evt.target.value},
    success:function(html) {
      console.log("User "+evt.target.value+" sent");
    }
  });
}

function nouser(){
  document.getElementById('userlog').parentNode.appendChild((document.createElement("span")).appendChild(document.createTextNode(" User don't exist")));
}

function wrong(){
  document.getElementById('passlog').parentNode.appendChild((document.createElement("span")).appendChild(document.createTextNode(" Wrong password")));
}

function rename (evt){
  elem1=(evt.target.parentNode.children[0].children[0].alt.split('_',2)[0]+'_'+evt.target.value+'.jpg');
  elem2=evt.target.parentNode.children[0].children[0].alt;
  $.ajax({
    type: "POST",
    url: 'Model/rename.php',
    data:{rename:elem1,name:elem2},
    success:function(html) {
      console.log(html);
      console.log("Renamed "+evt.target.parentNode.children[0].children[0].alt.split('_',2)[1]+" to "+evt.target.value+".jpg");
    }
  });
}

function addmoney (evt){
  user=evt.target.parentNode.children[0].innerHTML;
  // console.log(user);
  $.ajax({
    type: 'POST',
    url: 'Model/addmoney.php',
    data:{'money':5,'user':user},
    success:function(html) {
      console.log("Added "+"$5"+" to "+user+"."+html);
      user=evt.target.parentNode.children[1].innerHTML=parseInt(evt.target.parentNode.children[1].innerHTML)+5;
    }
  });
}

function takemoney (evt){
  user=evt.target.parentNode.children[0].innerHTML;
  // console.log(user);
  $.ajax({
    type: 'POST',
    url: 'Model/takemoney.php',
    data:{'money':5,'user':user},
    success:function(html) {
      console.log("Taken "+"$5"+" to "+user+"."+html);
      user=evt.target.parentNode.children[1].innerHTML=parseInt(evt.target.parentNode.children[1].innerHTML)-5;
    }
  });
}

function changedesc(prod) {
  desc=document.getElementsByTagName('textarea')[0].value;
  $.ajax({
    type: 'POST',
    url: 'Model/changedesc.php',
    data:{'desc':desc,'prod':prod},
    success:function(html) {
      console.log("Send comment '"+desc+"' to the server"+html);
    }
  });
}

function mr1(){
  document.getElementById('mr2').setAttribute("min",document.getElementById('mr1').value);
}

function mise(){
  num=document.getElementById('m1').value;
  prod=window.location.href.split('produit=',2)[1];
  $.ajax({
    type: 'POST',
    url: 'Model/mises.php',
    data:{'func':"mise",'num':num,'prod':prod},
    success:function(html) {
      console.log("Send comment '"+num+"' to the server for "+prod+html);
      if (html=="no money") {
        alert("Vous n'avez plus asser d'argent.");
      } else if (html=="mise") {
        alert("Vous avez misé.");
        // console.log("Vous avez $" + document.getElementById('mon').innerHTML.split('$',2)[1]);
        document.getElementById('mise').innerHTML+=num + " - ";
        document.getElementById('mon').innerHTML="Vous avez $" + parseInt(document.getElementById('mon').innerHTML.split('$',2)[1]-num);
      }
    }
  });
}

function rangemise(){
num1=document.getElementById('mr1').value;
num2=document.getElementById('mr2').value;
prod=window.location.href.split('produit=',2)[1];
  $.ajax({
    type: 'POST',
    url: 'Model/mises.php',
    data:{'func':"rangemise",'num1':num1,'num2':num2,'prod':prod},
    success:function(html) {
      console.log("Send comment '"+num1+"' and '"+num2+"' to the server for "+prod+html);
      if (html=="no money") {
        alert("Vous n'avez plus asser d'argent.");
      } else if (html=='mise') {
        alert("Vous avez misé.");
        money = parseInt(document.getElementById('mon').innerHTML.split('$',2)[1]);
        var i = num1;
        while (i<=num2) {
          i=parseFloat(i+0.01);
          document.getElementById('mise').innerHTML+=i + " - ";
          console.log(i);
          money=money-i;
          console.log(i+"+0.01");
          console.log(money);
        }
        document.getElementById('mon').innerHTML="Vous avez $" + money;
      } {
      }
    }
  });
}

function remove (evt){
  elem=evt.target.parentNode.children[0].children[0].src.split("/", 7)[6];
  // element=evt.target.parentNode.children[0].children[0].src.split("/", 7)[6];
  // element=element.split("%20");
  // elem="";
  // for(elements in element){
  //   elem+=element[elements]+" ";
  // }
  $.ajax({
     type: "POST",
     url: 'Model/remove.php',
     data:{remove:elem},
     success:function(html) {
       alert(html);
     }
  });
  // console.log(elem);
  // console.log(evt.target.parentNode.tagName);

  evt.target.parentNode.parentNode.removeChild(evt.target.parentNode);


  // console.log(evt.target.parentNode.children[1].innerHTML);

  // remove = evt.target;
  // var url = 'Model/remove.php';
  // $.post(url,{remove: "remove"});

  // var xhr = new XMLHttpRequest();
  // var formData = new FormData();
  // xhr.open('POST', url, true);
  // xhr.addEventListener('readystatechange', function(e) {
    // if (xhr.readyState == 4 && xhr.status == 200) {
      // console.log("File deleted");
    // }
    // else if (xhr.readyState == 4 && xhr.status != 200) {
      // console.log("File not deleted : "+formData+" "+xhr+" "+url);
    // }
  // })
  // formData.append('remove', remove);
  // xhr.send(formData);
}



// function disconnect(){
//   $.ajax({
//     type: "POST",
//     url:'Model/disconnect.php',
//     success:function(html) {
//       console.log("Session closed");
//     }
//   });
// }
