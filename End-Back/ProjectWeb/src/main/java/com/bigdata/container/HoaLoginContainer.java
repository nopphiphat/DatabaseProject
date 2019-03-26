package com.bigdata.container;


import com.bigdata.model.servicemodel.CustomerEmailForm;
import org.springframework.web.bind.annotation.*;


@RestController
public class HoaLoginContainer {


    //This functionality accept the param from plugin
    @CrossOrigin
    @GetMapping(value = "/hoa_login")
    public @ResponseBody void getHoaLogin(@RequestParam("username") String username,@RequestParam("password") String password){

        System.out.println(username+" "+password);

    }

    //This controller is used to receive form
    @CrossOrigin
    @PostMapping(value = "/hoa_c_send_email")
    public @ResponseBody void getCustomer(@RequestBody CustomerEmailForm emailForm){
        System.out.println(emailForm.getHoa_c_address());

r
    }
}
