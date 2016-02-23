<fieldset>
    <legend>INFORMATION</legend>
    <div class="form-group">
        <label for="title" class="col-sm-3 control-label">Title</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="title" name="title" placeholder="Post Title" required maxlength="70">
        </div>
    </div>
    <div class="form-group">
        <label for="slug" class="col-sm-3 control-label">Slug</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="slug" name="slug" placeholder="Custom slug for URL friendly" required maxlength="100">
            <span class="help-block"><i class="fa fa-info-circle mrs mts"></i>Default slug is good enough.</span>
        </div>
    </div>
    <div class="form-group">
        <label for="standard" class="col-sm-3 control-label">Post Format</label>
        <div class="col-sm-9">
            <div class="radio radio-inline">
                <input type="radio" name="format" id="standard" class="css-radio" checked required>
                <label for="standard" class="css-label">Standard</label>
            </div>
            <div class="radio radio-inline">
                <input type="radio" name="format" id="photo" class="css-radio">
                <label for="photo" class="css-label">Photo</label>
            </div>
            <div class="radio radio-inline">
                <input type="radio" name="format" id="video" class="css-radio">
                <label for="video" class="css-label">Video</label>
            </div>
        </div>
    </div>
</fieldset>
<fieldset>
    <legend>CATEGORY & TAGS</legend>
    <div class="form-group">
        <label for="category" class="col-sm-3 control-label">Category</label>
        <div class="col-sm-9">
            <label for="category" class="css-select">
                <select name="category" id="category" class="form-control" required>
                    <option value="">Select Category</option>
                    <option value="1">News</option>
                    <option value="2">Economic</option>
                    <option value="5">Entertainment</option>
                    <option value="4">Sport</option>
                    <option value="4">Health</option>
                    <option value="4">Science</option>
                    <option value="4">Technology</option>
                    <option value="4">Photo</option>
                    <option value="4">Video</option>
                    <option value="4">Others</option>
                </select>
            </label>
        </div>
    </div>
    <div class="form-group">
        <label for="subcategory" class="col-sm-3 control-label">Sub Category</label>
        <div class="col-sm-9">
            <label for="subcategory" class="css-select">
                <select name="subcategory" id="subcategory" class="form-control" required>
                    <option value="">Select Sub Category</option>
                    <optgroup label="Popular">
                        <option value="1">Soccer</option>
                        <option value="2">Tennis</option>
                        <option value="2">Basket</option>
                        <option value="2">Badminton</option>
                        <option value="2">Volley</option>
                        <option value="2">Athletic</option>
                        <option value="2">Bicycle</option>
                    </optgroup>
                    <optgroup label="Racing">
                        <option value="2">MotoGP</option>
                        <option value="2">Formula 1</option>
                        <option value="2">Rally</option>
                    </optgroup>
                    <optgroup label="Hardcore">
                        <option value="2">Extreme</option>
                        <option value="2">Freestyle</option>
                        <option value="2">Plane Jump</option>
                        <option value="2">Weight Lifting</option>
                    </optgroup>
                    <optgroup label="Event">
                        <option value="2">World Cup</option>
                        <option value="2">Olympic</option>
                        <option value="2">Champion</option>
                        <option value="2">Schedule</option>
                    </optgroup>
                </select>
            </label>
        </div>
    </div>
    <div class="form-group">
        <label for="tags" class="col-sm-3 control-label">Tags</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="tags" placeholder="Tag separated by coma" data-role="tagsinput" maxlength="100">
            <input type="text" class="form-control-dummy" id="tags-dummy" name="tags-dummy" />
        </div>
    </div>
</fieldset>
<fieldset>
    <legend>ARTICLE</legend>
    <div class="form-group">
        <label for="featured" class="col-sm-3 control-label">Featured</label>
        <div class="col-sm-9">
            <div class="css-file">
                <span class="file-info">No file selected</span>
                <button class="btn btn-primary" type="button">SELECT FEATURED</button>
                <input type="file" class="file-input" id="featured" name="featured" accept="image/*" required/>
            </div>
            <span class="help-block"><i class="fa fa-info-circle mrs mts"></i>Cover image for your post.</span>
        </div>
    </div>
    <div class="form-group">
        <label for="content" class="col-sm-3 control-label">Content</label>
        <div class="col-sm-9">
                                <textarea class="form-control summernote" name="content" id="content" cols="30"
                                          rows="10" placeholder="Write article here" required></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="excerpt" class="col-sm-3 control-label">Excerpt</label>
        <div class="col-sm-9">
            <textarea class="form-control" name="excerpt" id="excerpt" cols="30" rows="2" placeholder="Write an excerpt (optional)"></textarea>
            <span class="help-block"><i class="fa fa-info-circle mrs mts"></i>Add footer text for conclusion or quote.</span>
        </div>
    </div>
    <div class="form-group">
        <label for="published" class="col-sm-3 control-label">Status</label>
        <div class="col-sm-9">
            <div class="radio radio-inline">
                <input type="radio" name="status" id="published" class="css-radio" checked required>
                <label for="published" class="css-label">Published</label>
            </div>
            <div class="radio radio-inline">
                <input type="radio" name="status" id="draft" class="css-radio">
                <label for="draft" class="css-label">Draft</label>
            </div>
        </div>
    </div>
    <div class="form-group no-line">
        <div class="col-sm-offset-3 col-sm-9 pts pbm">
            <button class="btn btn-primary">CREATE ARTICLE</button>
            <a href="#discard" data-toggle="modal" class="btn btn-danger">DISCARD</a>
        </div>
    </div>
</fieldset>