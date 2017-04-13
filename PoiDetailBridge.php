<html>

    <h1>Poi Detail</h1>
    
    
    
    <form action="PoiDetail.php" id="useForm" method="post">
        <input id="useBox" name="locationName">
    </form>
    
    <script>
    
    document.getElementById('useBox').value = localStorage.getItem("ourPoi");
    localStorage.setItem("ourPoi","");
    document.getElementById("useForm").submit();
    </script>
    
    
</html>