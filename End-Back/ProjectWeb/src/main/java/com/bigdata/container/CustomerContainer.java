package com.bigdata.container;

import com.bigdata.hibernate.Comment;
import com.bigdata.hibernate.Customer;
import com.bigdata.model.MessageWrapper;
import com.bigdata.model.servicemodel.PersonalProfile;
import com.bigdata.model.servicemodel.TestComment;
import com.bigdata.service.CustomerService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.repository.query.Param;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;
import java.util.List;

@RestController
public class CustomerContainer {

    //return all user

    @Autowired
    private CustomerService customerService;

    @GetMapping(value = "all_profile")
    public @ResponseBody MessageWrapper getAllCustomerProfile(){


        List<Customer> customers = customerService.findAllCustomer();


        MessageWrapper<Customer> MWrapper = new MessageWrapper();

        MWrapper.setObjects(customers);

        return MWrapper;

    }

    @CrossOrigin
    @GetMapping(value = "shown_profile")
    public @ResponseBody MessageWrapper getShownProfile(){

        List<PersonalProfile> personalProfiles = new ArrayList<PersonalProfile>();

        PersonalProfile p = customerService.findShowProfileByEmail("15861800534@163.com");
        personalProfiles.add(p);

        MessageWrapper<PersonalProfile> MWrapper = new MessageWrapper();

        MWrapper.setObjects(personalProfiles);

        return MWrapper;

    }


    @CrossOrigin
    @PostMapping(value = "comment")
    public @ResponseBody void saveComment(@RequestBody Comment comment){
        String c = comment.getContent();
        System.out.println(c);
        //handle parameters

        //save parameters

        //get the information from factory

        //return message
    }
}
