package com.bigdata.container;

import com.bigdata.Imps.CustomerServiceImpl;
import com.bigdata.hibernate.Customer;
import com.bigdata.service.CustomerService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class TestContainer {

    @Autowired
    private CustomerService customerService;

    @GetMapping(value = "test")
    public @ResponseBody String testContainer(){
        return "abc";
    }
}
