package com.company.email.controllers;

import com.company.email.models.Email;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RestController;

import javax.mail.*;
import javax.mail.internet.InternetAddress;
import javax.mail.internet.MimeMessage;
import javax.mail.internet.MimeUtility;
import java.io.*;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.Properties;


@RestController
public class EmailReceiverController {
    @RequestMapping(value = "/get_emails", method = RequestMethod.GET)
    public ResponseEntity<Object> getAllEmails() {
        ArrayList<Email> emails = new ArrayList<>();
        try {
            emails = receive();
            return new ResponseEntity<>(emails, HttpStatus.OK);
        } catch (Exception ex) {
            ex.printStackTrace();
            return new ResponseEntity<>(emails, HttpStatus.BAD_REQUEST);
        }
    }

    @RequestMapping(value = "/delete_email/{number}", method = RequestMethod.DELETE)
    public ResponseEntity<Object> deleteEmail(@PathVariable("number") int number) {
        try {
            delete(number);
            return new ResponseEntity<>("success", HttpStatus.OK);
        } catch (Exception ex) {
            ex.printStackTrace();
            return new ResponseEntity<>("fail to delete the email", HttpStatus.BAD_REQUEST);
        }
    }

    public static Store connectPOP3() throws Exception {
        /*
        Replace this part to change the POP3 settings
         */
        Properties props = new Properties();
        props.setProperty("mail.store.protocol", "pop3");
        props.setProperty("mail.pop3.port", "995");
        props.setProperty("mail.pop3.host", "host");
        props.setProperty("mail.pop3.ssl.enable", "true");

        Session session = Session.getInstance(props);
        Store store = session.getStore("pop3");
        store.connect("email address", "password");
        return store;
    }

    public static ArrayList<Email> receive() throws Exception {
        Store store = connectPOP3();
        Folder folder = store.getFolder("INBOX");

        folder.open(Folder.READ_WRITE);

        Message[] messages = folder.getMessages();
        ArrayList<Email> emails = parseMessage(messages);
        folder.close(true);
        store.close();
        return emails;
    }

    public static void delete(int number) throws Exception {
        try {
            Store store = connectPOP3();
            Folder folder = store.getFolder("INBOX");
            folder.open(Folder.READ_WRITE);

            BufferedReader reader = new BufferedReader(new InputStreamReader(System.in));
            Message[] messages = folder.getMessages();
            Message message = messages[number - 1];
            message.setFlag(Flags.Flag.DELETED, true);
            // expunges the folder to remove messages which are marked deleted
            folder.close(true);
            store.close();
        } catch (NoSuchProviderException e) {
            e.printStackTrace();
        }
    }

    public static ArrayList<Email> parseMessage(Message[] messages) throws MessagingException, IOException {
        ArrayList<Email> emails = new ArrayList<>();
        for (int i = 0, count = messages.length; i < count; i++) {
            MimeMessage msg = (MimeMessage) messages[i];
            Email email = new Email();
            email.setNumber(msg.getMessageNumber());
            email.setSubject(getSubject(msg));
            email.setFrom(getFrom(msg));
            email.setTo(getReceiveAddress(msg, null));
            email.setDate(getSentDate(msg, null));
            StringBuffer content = new StringBuffer();
            getMailTextContent(msg, content);
            email.setBody(content.toString());
            emails.add(email);
        }
        return emails;
    }

    public static String getSubject(MimeMessage msg) throws UnsupportedEncodingException, MessagingException {
        return MimeUtility.decodeText(msg.getSubject());
    }

    public static String getFrom(MimeMessage msg) throws MessagingException, UnsupportedEncodingException {
        String from = "";
        Address[] froms = msg.getFrom();
        if (froms.length < 1)
            throw new MessagingException("sender not found!");

        InternetAddress address = (InternetAddress) froms[0];
        String person = address.getPersonal();
        if (person != null) {
            person = MimeUtility.decodeText(person) + " ";
        } else {
            person = "";
        }
        from = person + "<" + address.getAddress() + ">";

        return from;
    }

    public static String getReceiveAddress(MimeMessage msg, Message.RecipientType type) throws MessagingException {
        StringBuffer receiveAddress = new StringBuffer();
        Address[] addresss = null;
        if (type == null) {
            addresss = msg.getAllRecipients();
        } else {
            addresss = msg.getRecipients(type);
        }

        if (addresss == null || addresss.length < 1) {
            throw new MessagingException("receiver not found!");
        }
        for (Address address : addresss) {
            InternetAddress internetAddress = (InternetAddress) address;
            receiveAddress.append(internetAddress.toUnicodeString()).append(",");
        }

        receiveAddress.deleteCharAt(receiveAddress.length() - 1);

        return receiveAddress.toString();
    }

    public static String getSentDate(MimeMessage msg, String pattern) throws MessagingException {
        Date receivedDate = msg.getSentDate();
        if (receivedDate == null)
            return "";

        if (pattern == null || "".equals(pattern)) {
            pattern = "MM/dd/yyyy";
        }

        return new SimpleDateFormat(pattern).format(receivedDate);
    }

    public static void getMailTextContent(Part part, StringBuffer content) throws MessagingException, IOException {
        boolean isContainTextAttach = part.getContentType().indexOf("name") > 0;
        if (part.isMimeType("text/*") && !isContainTextAttach) {
            content.append(part.getContent().toString());
        } else if (part.isMimeType("message/rfc822")) {
            getMailTextContent((Part) part.getContent(), content);
        } else if (part.isMimeType("multipart/*")) {
            Multipart multipart = (Multipart) part.getContent();
            int partCount = multipart.getCount();
            for (int i = 0; i < partCount; i++) {
                BodyPart bodyPart = multipart.getBodyPart(i);
                getMailTextContent(bodyPart, content);
            }
        }
    }

}
