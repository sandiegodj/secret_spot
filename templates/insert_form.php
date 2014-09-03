<div id= "middle">
    Where you at?
<form action="insert.php" method="post">
    <fieldset>
        <div class="form-group">
            <select required name="spot">
                <option value=''> <b></b> </option>
                <option value='Blacks'> Blacks</option>
                <option value='Scripps'> Scripps </option>
                <option value='Hogans'> Hogan's</option>
                <option value='OceanBeach'>Ocean Beach'</option>
                <option value='SunsetCliffs'> Sunset Cliffs </option>
                <option value='ImperialBeach'> Imperial Beach </option>             
            </select>
        </div>
         <div id="height">
            <input type="radio" name="height" required value="Flat">Flat&nbsp; &nbsp;
            <input type="radio" name="height" value="2-3">2-3&nbsp; &nbsp;
            <input type="radio" name="height" value="3-4">3-4&nbsp; &nbsp;
            <input type="radio" name="height" value="4-5">4-5&nbsp; &nbsp;
            <input type="radio" name="height" value="6+">6++&nbsp; &nbsp;
        </div>
        <div id="rating">
            <input type="radio" name="rating" required value="Poor">Poor&nbsp; &nbsp;
            <input type="radio" name="rating" value="Fair">Fair&nbsp; &nbsp;
            <input type="radio" name="rating" value="Good">Good&nbsp; &nbsp;
            <input type="radio" name="rating" value="Great">Great&nbsp; &nbsp;
            <input type="radio" name="rating" value="Excellent">Excellent&nbsp; &nbsp;
        </div>
        <div id= "condition">
            <input type="radio" name="conditions" required value="Walled">Walled&nbsp; &nbsp;
            <input type="radio" name="conditions" value="Sectiony">Sectiony&nbsp; &nbsp;
            <input type="radio" name="conditions" value="Peaky">Peaky&nbsp; &nbsp;
            <input type="radio" name="conditions" value="Tubes">Tubing&nbsp; &nbsp;
            <input type="radio" name="conditions" value="N/A">N/A&nbsp; &nbsp;
        </div>
        <div id="description">
            <input type="text" required name="description" placeholder="Description (Be Detailed)"/>
        </div>     
        <div class="submit">
            <button type="submit" class="btn btn-default btn-sm">Submit</button>
        </div>
    </fieldset>
</form>
<span><a href="lookup.php">Spot Data</a></span>
</div>
