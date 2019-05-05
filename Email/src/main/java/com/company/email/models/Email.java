package com.company.email.models;

public class Email {
    private Integer number;
    private String from;
    private String to;
    private String subject;
    private String date;
    private String body;

    public Email() {

    }

    public Email(Integer number, String from, String to, String subject, String date, String body) {
        this.number = number;
        this.from = from;
        this.to = to;
        this.subject = subject;
        this.date = date;
        this.body = body;
    }

    public String getFrom() {
        return from;
    }

    public void setFrom(String from) {
        this.from = from;
    }

    public String getTo() {
        return to;
    }

    public void setTo(String to) {
        this.to = to;
    }

    public String getSubject() {
        return subject;
    }

    public void setSubject(String subject) {
        this.subject = subject;
    }

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public String getBody() {
        return body;
    }

    public void setBody(String body) {
        this.body = body;
    }

    public Integer getNumber() {
        return number;
    }

    public void setNumber(Integer number) {
        this.number = number;
    }
}
