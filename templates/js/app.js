window.onload=()=>{
    data={
        name:"name",
        region:"region",
    }
    const getRegions=async ()=>{
        const request= await fetch('http://localhost/map/api/getData.php', {
         method:"POST",
         headers: {
            'Content-Type': 'application/json',
          },   
          body:JSON.stringify(data)
        })
        if(request.status==200){
        const result= await request.json();
        console.log(result)
        return result;
    }
    else{
        return 'server error';
    }
    }   


    const displayRegions=(regions)=>{
        console.log(55)
        if(Array.isArray(regions)){
            let Select = document.getElementById('regions');
            for(let i = 0; i< regions.length;i++){
                let option= document.createElement('option');
                option.setAttribute('value', regions[i].id)
                console.log(option);
                option.innerHTML=regions[i].region;
                Select.appendChild(option);
            }
        }
    }
    
    

    async function initPage(){
        let rows= await getRegions();
        displayRegions(rows);
    }
    initPage();
}