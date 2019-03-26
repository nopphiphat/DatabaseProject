package com.bigdata.container;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class TestContainer {
    

    @GetMapping(value = "test")
    public @ResponseBody String testContainer(){
        return "abc";
    }
}
