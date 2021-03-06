## Challenge ##
Create a small app to process and display data
Assign different levels of gradation to each data row based on deviation from average.

Use only Javascript and Sass for frontend
Backend can be anything.

**Implement both backend and frontend solution**

### Planing Phase ###
> 1. Need a rest api endpoint to get the processed data from a json data set. 
    create a textarea that will hold data
(**Optionaly** add caching to avoid redoing the calculations.)
    Prefered format:

    {
        data: [{x:<int>, y:<int>, value: <int>, level: <int>}*]
    }
> 2. Another API endpoint would be ok to have to get the legend. Indexes would match the level value on the POST request.

    {
        data: ["0%-5%", "5%-25%", *]
    }
> 3. Build a front-end script that can request for data via an ajax call (2 for the legends as well) and display it onto a canvas.Might just use the HTML5 canvas element.  
    
    1. Build the canvas solution

    2. Get the data from the api end points and plot it onto the canvas.

    3. Display some info on hover (optional)


### Building Phase ###
#### Backend ####
- [x] set-up backend. Install Lumen.
    Requirements:
    ```
        PHP >= 7.1.3
        OpenSSL PHP Extension
        PDO PHP Extension
        Mbstring PHP Extension
- [x] create tests for 2 end-points (one POST request and the other just a GET request)
- [x] implement both end-points to satisfy the tests
- [x] implement validation
- [x] implement logic that would return the expected data format
- [ ] create an md5 hash of the file and save the processed results in cache to be served on subsequent requests (optional)


#### Frontend ####
- [x] create a layout with a textarea and a **Show Data** button
- [x] create a function that sends out ajax request to the backend (POST and GET)
- [x] display data on the canvas
- [x] add option to keep or regenerate legend colors
- [x] handle request error messages

### Set up ###

1. clone repository
2. run commands

``` composer install ```

``` npm install ```

``` npm run dev ```

or 

```npm run prod ```
(for extra asset processing)

3. spin up a server process or use php default one

```php -S localhost:<port number> -t public```
