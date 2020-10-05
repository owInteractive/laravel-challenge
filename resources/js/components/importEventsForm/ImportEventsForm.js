import React from 'react';
import './ImportEventsForm.scss';
import {
    Form,
    Select,
    InputNumber,
    Switch,
    Radio,
    Slider,
    Button,
    Upload,
    Icon,
    Rate,
    Checkbox,
    Row,
    Col,
} from 'antd';
import axios from 'axios';


const ImportForm = props => {
    const { getFieldDecorator } = props.form;
    const handleSubmit = e => {
        e.preventDefault();
        props.form.validateFields((err, values) => {
            if (!err) {
                console.log('Received values of form: ', values);
                axios.get(`http://127.0.0.1:8000/importEvents`, { values });
            }
        });
    };
    const normFile = e => {
        console.log('Upload event:', e);
        if (Array.isArray(e)) {
            return e;
        }
        return e && e.fileList;
    };

    return (
        <Form onSubmit={handleSubmit}>
            <Form.Item label="file">
                {getFieldDecorator('file', {
                    valuePropName: 'fileList',
                    getValueFromEvent: normFile,
                })(
                    <Upload
                        accept=".txt, .csv"
                        showUploadList={false}
                        beforeUpload={file => {
                            const reader = new FileReader();

                            reader.onload = e => {
                                console.log(e.target.result);
                            };
                            reader.readAsText(file);

                            // Prevent upload
                            return false;
                        }}
                    >
                        <Button>
                            <Icon type="upload" /> Click to Upload
    </Button>
                    </Upload>,
                )}
            </Form.Item>
            <Form.Item wrapperCol={{ span: 12, offset: 6 }}>
                <Button type="primary" htmlType="submit">
                    Submit
          </Button>
            </Form.Item>

        </Form>
    );
};

const ImportEventsForm = Form.create({ name: 'validate_other' })(ImportForm);
export default ImportEventsForm;
